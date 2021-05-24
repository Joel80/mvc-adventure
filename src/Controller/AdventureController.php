<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Adventure\AdventureSetup;
use App\Entity\RoomDescriptor;
/* use App\Entity\Log; */
use App\Entity\AchievementLog;
use App\Entity\ItemDescriptor;
use App\Entity\ExitDescriptor;
use App\Entity\EventDescriptor;
use App\Entity\Visit;
use App\Entity\RoomVisitLog;
use App\Adventure\AdventureManagerCreator;
//use DateTime;
use App\Adventure\DbDataHandler;

class AdventureController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Controller for adventure routes
     */
    public function playGame(): Response
    {

        $adventureManager = $this->session->get('manager', null);

        if (!$adventureManager) {
            return $this->render(
                'adventure/setup.html.twig'
            );
        }

        $lastAchievement = $adventureManager
            ->getAdventureEventManager()
            ->getLastAchievement()
        ;

        if ($lastAchievement) {
            /** @var \Doctrine\ORM\EntityManagerInterface */
            $entityManager = $this->getDoctrine()->getManager();

            $logId = $adventureManager->getAchievementLog()->getId();

            $log = $this->getDoctrine()
            ->getRepository(AchievementLog::class)
            ->find($logId);

            //$log = $entityManager->getReference('App\Entity\AchievementLog', $logId);

            $lastAchievement->setAchievementLog($log);

            $entityManager->persist($lastAchievement);

            $entityManager->flush();

            $adventureManager
                ->getAdventureEventManager()
                ->setLastAchievement(null)
            ;
        }

        $adventureManager->getAdventureDataSetter()->setData();

        $data = $adventureManager->getAdventureDataSetter()->getAdventureData();

        return $this->render(
            'adventure/play.html.twig',
            ['data' => $data]
        );
    }

    public function move(Request $request)
    {
        $adventureManager = $this->session->get('manager');

        $nextRoomIndex = $request->get('roomIndex');

        $nextRoom = $adventureManager
            ->getMap()
            ->getRoom($nextRoomIndex)
        ;

        $adventureManager
            ->getPlayer()
            ->getCurrentRoom()
            ->removeTempDescriptions()
        ;

        $adventureManager
            ->getPlayer()
            ->setCurrentRoom($nextRoom)
        ;
        /** @var \Doctrine\ORM\EntityManagerInterface */
        $entityManager = $this->getDoctrine()->getManager();

        $logId = $adventureManager->getRoomVisitLog()->getId();

        $log = $entityManager->getReference('App\Entity\RoomVisitLog', $logId);

        $visits = $log->getVisits();

        foreach ($visits as $visit) {
            if ($visit->getRoomIndex() === $nextRoomIndex) {
                $timesVisited = $visit->getTimesVisited();
                $timesVisited++;
                $visit->setTimesVisited($timesVisited);

                $entityManager->persist($visit);

                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }

    public function pickUp(Request $request)
    {
        $adventureManager = $this->session->get('manager');

        $itemToPickId = $request->get('itemId');

        $item = $adventureManager
            ->getPlayer()
            ->getCurrentRoom()
            ->getInventory()
            ->getItem($itemToPickId)
        ;

        $adventureManager
            ->getPlayer()
            ->getInventory()
            ->addItem($item, $item->getItemId())
        ;

        $adventureManager
            ->getPlayer()
            ->getCurrentRoom()
            ->getInventory()
            ->removeItem($itemToPickId)
        ;

        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }

    public function useItem(Request $request)
    {
        $adventureManager = $this->session->get('manager');

        $itemId = $request->get('itemId');

        $roomIndex = $request->get('roomIndex');

        $player = $adventureManager->getPlayer();

        $adventureManager
            ->getAdventureEventManager()
            ->checkEvent($itemId, $roomIndex, $player)
        ;

        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }

    public function setup(Request $request)
    {
        //Get player name
        $playerName = $request->get('playerName');

        /** @var \Doctrine\ORM\EntityManagerInterface */
        $entityManager = $this->getDoctrine()->getManager();

        //Create dataHandler
        $dbDataHandler = new DbDataHandler($entityManager);

        //Create achievement log
        $adventureLog = $dbDataHandler->createAchievementLog($playerName);

        //Get descriptors from db
        $roomDescriptors = $dbDataHandler->getRoomDescriptors();
        $itemDescriptors = $dbDataHandler->getItemDescriptors();
        $eventDescriptors = $dbDataHandler->getEventdescriptors();
        $exitDescriptors = $dbDataHandler->getExitDescriptors();

        //Create room visit log
        $roomVisitLog = $dbDataHandler->createRoomVisitLog($roomDescriptors, $playerName);

        //Create setup
        $setup = new AdventureSetup();

        //Setup game data from descriptors
        $setupObjects = $setup->setup($roomDescriptors, $itemDescriptors, $exitDescriptors, $eventDescriptors);

        //Create adventure manager
        $creator = new AdventureManagerCreator();

        $adventureManager = $creator->createAdventureManager($setupObjects, $roomVisitLog, $adventureLog);

        //Store manager in session
        $this->session->set('manager', $adventureManager);

        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }

    public function endGame()
    {
        //Remove manager from session
        $this->session->remove('manager');

        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }
}
