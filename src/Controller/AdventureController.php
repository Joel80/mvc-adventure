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

        if($lastAchievement) {

            $entityManager = $this->getDoctrine()->getManager();

            $logId = $adventureManager->getAchievementLog()->getId();

            $log = $entityManager->getReference('App\Entity\AchievementLog', $logId);

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
            ->getCurrentPlayerRoom()
            ->removeTempDescriptions()
        ;

        $adventureManager
            ->getPlayer()
            ->setCurrentRoom($nextRoom)
        ;

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
        $playerName = $request->get('playerName');
        //Create log and set date
        $adventureLog = new AchievementLog();

        $adventureLog->setDate(new \DateTime());

        $adventureLog->setPlayerName($playerName);

        //Save log object in database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($adventureLog);
        $entityManager->flush();

        //Get the room descriptors from the database
        $roomDescriptors = $entityManager
        ->getRepository(RoomDescriptor::class)
        ->findAll();

        //Get the item descriptors from the database
        $itemDescriptors = $entityManager
        ->getRepository(ItemDescriptor::class)
        ->findAll();

        //Get the exit descriptors from the database
        $exitDescriptors = $entityManager
        ->getRepository(ExitDescriptor::class)
        ->findAll();

        //Get the event descriptors from the database
        $eventDescriptors = $entityManager
        ->getRepository(EventDescriptor::class)
        ->findAll();

        $roomVisitLog = new RoomVisitLog();

        $roomVisitLog->setDate(new \DateTime);

        $roomVisitLog->setPlayerName($playerName);

        $entityManager->persist($roomVisitLog);
        $entityManager->flush();


        foreach($roomDescriptors as $roomDescriptor) {
            $roomName = $roomDescriptor->getRoomName();
            $roomIndex = $roomDescriptor->getRoomIndex();
            $visit = new Visit();
            $visit->setRoomName($roomName);
            $visit->setRoomIndex($roomIndex);
            $visit->setTimesVisited(0);
            $visit->setRoomVisitLog($roomVisitLog);
            $entityManager->persist($visit);
        }

        $entityManager->flush();

        $setup = new AdventureSetup();

        $adventureManager = $setup->setup($adventureLog, $roomDescriptors, $itemDescriptors, $exitDescriptors, $eventDescriptors, $roomVisitLog);

        $this->session->set('manager', $adventureManager);

        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }

    public function endGame()
    {
        $this->session->remove('manager');

        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }
}
