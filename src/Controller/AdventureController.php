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
use App\Entity\Log;


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

        $lastEvent = $adventureManager
            ->getAdventureEventManager()
            ->getLastEvent()
        ;

        if($lastEvent) {

            $entityManager = $this->getDoctrine()->getManager();

            $logId = $adventureManager->getLog()->getId();

            $log = $entityManager->getReference('App\Entity\Log', $logId);

            $lastEvent->setLog($log);

            $entityManager->persist($lastEvent);

            $entityManager->flush();

            $adventureManager
                ->getAdventureEventManager()
                ->setLastEvent(null)
            ;
        }

        $adventureManager->setCurrentPlayerRoomDescriptionData();

        $adventureManager->setCurrentPlayerRoomExitsData();

        $adventureManager->setCurrentPlayerRoomItemsData();

        $adventureManager->setPlayerItemsData();

        $adventureManager->setCurrentPlayerRoomIndexData();

        $adventureManager->setCurrentPlayerRoomTempDescriptionsData();

        $adventureManager->setCurrentPlayerRoomImageData();

        $adventureManager->setCurrentPlayerRoomNameData();

        $data = $adventureManager->getAdventureData();

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
        
            //var_dump($item);

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

        $map = $adventureManager->getMap();

        $player = $adventureManager->getPlayer();

        $adventureManager
            ->getAdventureEventManager()
            ->checkEvent($itemId, $roomIndex, $map, $player)
        ;
        /* $adventureManager->checkItemUse($itemId, $roomIndex); */

        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }

    public function setup()
    {
        //Create log and set date
        $adventureLog = new Log();

        $adventureLog->setDate(new \DateTime());

        //Save log object in database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($adventureLog);
        $entityManager->flush();

        //Get the room descriptors from the database
        $roomDescriptors = $entityManager
        ->getRepository(RoomDescriptor::class)
        ->findAll();

        $setup = new AdventureSetup();

        $adventureManager = $setup->setup($adventureLog, $roomDescriptors);

        $this->session->set('manager', $adventureManager);

        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }

    public function endGame()
    {
        $this->session->remove('manager');

        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }
}
