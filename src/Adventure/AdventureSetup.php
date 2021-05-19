<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Player;
use App\Adventure\Room;
use App\Adventure\RoomExit;
use App\Adventure\AdventureData;
use App\Adventure\AdventureManager;
use App\Adventure\Map;
use App\Entity\Event;
use App\Entity\Log;
use App\Adventure\Inventory;
use App\Adventure\Item;
use App\Entity\RoomDescriptor;

class AdventureSetup
{
    public function __construct()
    {}

    public function setup(Log $adventureLog, array $roomDescriptors)
    {
        $map = new Map();

        $rooms = [];

        foreach ($roomDescriptors as $roomDescriptor) {

            $roomDescription = $roomDescriptor->getDescription();
            $roomIndex = $roomDescriptor->getRoomIndex();
            $roomImage = $roomDescriptor->getRoomImage();
            $roomName = $roomDescriptor->getRoomName();
            $room = new Room($roomDescription, $roomIndex, $roomImage, $roomName);

            $map->addRoom($room, $roomIndex);
        }

        /* $room1 = $rooms["roomOne"];
        $room2 = $rooms["roomTwo"];
        $room3 = $rooms["roomThree"];
        $room4 = $rooms["roomFour"];
        $room5 = $rooms["roomFive"];
        $room6 = $rooms["roomSix"];
        $room7 = $rooms["roomOnePostEv1"];
        $room8 = $rooms["roomOnePostEv2"];
        $room9 = $rooms["roomTwoPostEv3"];
        $room10 = $rooms["roomThreePostEv4"];
        $room11 = $rooms["roomFivePostEv5"]; */

        //Add inventories to rooms
        $room1Inventory = new Inventory();

        $idCard = new Item("An ID card", "ID card", "idCard", "An ID card lies in the debris on a desk.");

        $room1Inventory->addItem($idCard, $idCard->getItemId());

        $map
            ->getRoom("roomOne")
            ->setInventory($room1Inventory)
        ;

        $room2Inventory = new Inventory();

        $ironBar = new Item("An iron bar", "Iron bar", "ironBar", "An iron bar stands in one corner");

        $room2Inventory->addItem($ironBar, $ironBar->getItemId());

        $map
            ->getRoom("roomTwo")
            ->setInventory($room2Inventory)
        ;

        $map
            ->getRoom("roomThree")
            ->setInventory(new Inventory)
        ;

        $calculator = new Item("A broken calculator", "Broken calculator - the seven seems to be missing", "calculator", "A broken calculator lies on the floor.");

        $room4Inventory = new Inventory();

        $room4Inventory->addItem($calculator, $calculator->getItemId());

        $map
            ->getRoom("roomFour")
            ->setInventory($room4Inventory)
        ;

        $dirtyCloth = new Item("Dirty cloth rag", "Dirty cloth rag", "dirtyClothRag", "A dirty cloth rag hangs on the wall next to the southern exit.");

        $room5Inventory = new Inventory();

        $room5Inventory->addItem($dirtyCloth, $dirtyCloth->getItemId());

        $map
            ->getRoom("roomFive")
            ->setInventory($room5Inventory)
        ;

        $map
            ->getRoom("roomSix")
            ->setInventory(new Inventory)
        ;

        //Add exits to rooms
        $map
            ->getRoom("roomTwo")
            ->addExit(new RoomExit($map->getRoom("roomOne"), "Southern Exit"));
        ;

        $map
            ->getRoom("roomTwo")
            ->addExit(new RoomExit($map->getRoom("roomThree"), "Eastern Exit"));
        ;

        $map
            ->getRoom("roomThree")
            ->addExit(new RoomExit($map->getRoom("roomTwo"), "Western Exit"));
        ;

        $map
            ->getRoom("roomThree")
            ->addExit(new RoomExit($map->getRoom("roomFour"), "Eastern Exit"));
        ;

        $map
            ->getRoom("roomThree")
            ->addExit(new RoomExit($map->getRoom("roomFive"), "Northern Exit"));
        ;

        $map
            ->getRoom("roomFour")
            ->addExit(new RoomExit($map->getRoom("roomThree"), "Western Exit"));
        ;

        $map
        ->getRoom("roomFive")
        ->addExit(new RoomExit($map->getRoom("roomThree"), "Southern Exit"));
    ;
        /* $room2->addExit(new RoomExit($room1, "Southern Exit"));

        $room2->addExit(new RoomExit($room3, "Eastern Exit"));

        $room3->addExit(new RoomExit($room2, "Western exit"));

        $room3->addExit(new RoomExit($room4, "Eastern exit"));

        $room3->addExit(new RoomExit($room5, "Northern exit"));

        $room4->addExit(new RoomExit($room3, "Western exit"));

        $room5->addExit(new RoomExit($room3, "Southern exit"));*/

        /* $map->addRoom($room1, $room1->getRoomIndex());
        $map->addRoom($room2, $room2->getRoomIndex());
        $map->addRoom($room3, $room3->getRoomIndex());
        $map->addRoom($room4, $room4->getRoomIndex());
        $map->addRoom($room5, $room5->getRoomIndex());
        $map->addRoom($room6, $room6->getRoomIndex());
        $map->addRoom($room6, $room6->getRoomIndex());
        $map->addRoom($room7, $room7->getRoomIndex());
        $map->addRoom($room8, $room8->getRoomIndex());
        $map->addRoom($room9, $room9->getRoomIndex());
        $map->addRoom($room10, $room10->getRoomIndex());
        $map->addRoom($room11, $room11->getRoomIndex()); */

        //Create player
        $player = new Player($map->getRoom("roomOne"));

        $playerInventory = new Inventory();

        $player->setInventory($playerInventory);

        //Create adventureData
        $adventureData = new AdventureData();

        //Create adventuerEventManager
        $eventManager = new AdventureEventManager(5);

        //Create and return adventureManager
        $adventureManager = new AdventureManager($player, $adventureData, $map, $adventureLog, $eventManager);

        return $adventureManager;
    }
}