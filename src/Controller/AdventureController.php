<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Adventure\Room;
use App\Adventure\Player;
use App\Adventure\AdventureData;
use App\Adventure\AdventureManager;
use App\Adventure\RoomExit;
use App\Adventure\Map;
use App\Adventure\Inventory;
use App\Adventure\Item;
use App\Entity\Event;
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
            $map = new Map();
            
            $room2 = new Room("This room is lit in a steady red emergency light. Dust covers the floor.
            Water drips from the ceiling high above and forms a small pool in the middle of the floor.
            There is an exit to the south and an exit to the east.", "roomTwo");

            $room2Inventory = new Inventory();

            $ironBar = new Item("An iron bar", "Iron bar", "ironBar", "An iron bar stands in one corner");

            $room2Inventory->addItem($ironBar, $ironBar->getItemId());

            $room2->setInventory($room2Inventory);

            $room1 = new Room("You are in in a room filled with debris. Desks and overturned chairs litter the room. 
            Severed cables hangs from the ceiling. Red flashing emergency light fills the room and you can see a small 
            locker in one corner of the room. The locker door is slightly ajar but seems jammed. To the north is a great 
            door it is shut and seems impossible to open by force. There is a small slot next to the door.", "roomOne");

            $room1Inventory = new Inventory();

            $idCard = new Item("An ID card", "ID card", "idCard", "An ID card lies in the debris on a desk.");

            $room1Inventory->addItem($idCard, $idCard->getItemId());

            $room1->setInventory($room1Inventory);

            //$room1->addExit(new RoomExit($room2, "Northern Exit"));

            $room3 = new Room("This room seems to get it's power from another power source. It is dark but a small computer on
            a desk in the corner seems to be working. The screen flashes: 'Authorization needed.' There is an exit to the west, 
            an exit to the east and an exit to the north", "roomThree");

            $room4 = new Room("This room resembles the first room desks, overturned chairs and yellowed paper litters the floor. There is an exit to the west.", "roomFour");

            $calculator = new Item("A broken calculator", "Broken calculator - the seven seems to be missing", "calculator", "A broken calculator lies on the floor.");

            $room4Inventory = new Inventory();

            $room4Inventory->addItem($calculator, $calculator->getItemId());

            $room4->setInventory($room4Inventory);

            $room5 = new Room("The power seems to be working in this this great hall. It basks in flickering yellow light. The room is dominated by
            a large vault door on the northern wall. Next to the door is a keypad. There is an exit to the south.", "roomFive");

            $dirtyCloth = new Item("Dirty cloth rag", "Dirty cloth rag", "dirtyClothRag", "A dirty cloth rag hangs on the wall next to the southern exit.");

            $room5Inventory = new Inventory();

            $room5Inventory->addItem($dirtyCloth, $dirtyCloth->getItemId());

            $room5->setInventory($room5Inventory);

            

            $room6 = new Room("You are outside, free once again. But the world has changed. The sky is ashen grey, the soil is twisted and burned. Dust storms rages on the horizon. 
            To the north you think you can spot some ruins. After a brief moment of hesitation you move on towards the ruins - braving this new desolated world.", "roomSix");

            $room6->setInventory(new Inventory);

            $room2->addExit(new RoomExit($room1, "Southern Exit"));

            $room2->addExit(new RoomExit($room3, "Eastern Exit"));

            $room3->addExit(new RoomExit($room2, "Western exit"));

            $room3->addExit(new RoomExit($room4, "Eastern exit"));

            $room3->addExit(new RoomExit($room5, "Northern exit"));

            $room4->addExit(new RoomExit($room3, "Western exit"));

            $room5->addExit(new RoomExit($room3, "Southern exit"));

            $room3->setInventory(new Inventory);


            $map->addRoom($room1, $room1->getRoomIndex());
            $map->addRoom($room2, $room2->getRoomIndex());
            $map->addRoom($room3, $room3->getRoomIndex());
            $map->addRoom($room4, $room4->getRoomIndex());
            $map->addRoom($room5, $room5->getRoomIndex());
            $map->addRoom($room6, $room6->getRoomIndex());
            
            $player = new Player($room1);

            $playerInventory = new Inventory();

            $player->setInventory($playerInventory);

            $adventureData = new AdventureData();

            $adventureLog = new Log();

            $adventureLog->setDate(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adventureLog);
            $entityManager->flush();

            $adventureManager = new AdventureManager($player, $adventureData, $map, $adventureLog);

            $this->session->set('manager', $adventureManager);
        }

        $lastEvent = $adventureManager->getLastEvent();

        if($lastEvent) {

            $entityManager = $this->getDoctrine()->getManager();

            $logId = $adventureManager->getLog()->getId();

            $log = $entityManager->getReference('App\Entity\Log', $logId);

            //var_dump($logId);

            $lastEvent->setLog($log);

            $entityManager->persist($lastEvent);

            $entityManager->flush();

            $adventureManager->setLastEvent(null);
        }

        $adventureManager->setCurrentPlayerRoomDescriptionData();

        $adventureManager->setCurrentPlayerRoomExitsData();

        $adventureManager->setCurrentPlayerRoomItemsData();

        $adventureManager->setPlayerItemsData();

        $adventureManager->setPlayerRoomIndexData();

        $adventureManager->setPlayerRoomTempDescriptionsData();

        $data = $adventureManager->getAdventureData();

        /* var_dump($data['playerRoomItems']); */

        return $this->render(
            'adventure/play.html.twig',
            ['data' => $data]
        );
    }

    public function move(Request $request)
    {
        $adventureManager = $this->session->get('manager');
        $nextRoomIndex = $request->get('roomIndex');
        $nextRoom = $adventureManager->getRoomFromMap($nextRoomIndex);

        $adventureManager
            ->getCurrentPlayerRoom()
            ->removeTempDescriptions()
            ;
        $adventureManager->movePlayer($nextRoom);

        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }

    public function pickUp(Request $request)
    {
        $adventureManager = $this->session->get('manager');
        $itemToPickId = $request->get('itemId');

        $item = $adventureManager
            ->getCurrentPlayerRoom()
            ->getInventory()
            ->getItem($itemToPickId)
            ;
        
            var_dump($item);

        $adventureManager
            ->getPlayerInventory()
            ->addItem($item, $item->getItemId())
            ;
        
        $adventureManager
            ->getCurrentPlayerRoom()
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

        $adventureManager->checkItemUse($itemId, $roomIndex);

        return $this->redirectToRoute('app_adventure_play_game', [], 301);
    }
}
