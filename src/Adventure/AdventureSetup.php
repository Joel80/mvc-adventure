<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Player;
use App\Adventure\Room;
use App\Adventure\RoomExit;
use App\Adventure\AdventureData;
use App\Adventure\AdventureManager;
use App\Adventure\Map;
use App\Adventure\Event;
use App\Entity\Achievement;
use App\Entity\AchievementLog;
use App\Adventure\Inventory;
use App\Adventure\Item;
use App\Entity\RoomDescriptor;
use App\Adventure\AdventureDataSetter;
use App\Entity\RoomVisitLog;
use App\Entity\Visit;

class AdventureSetup
{
    private array $setupObjects;

    public function __construct()
    {
        $this->setupObjects = [];
    }

    public function setup(array $roomDescriptors, array $itemDescriptors, array $exitDescriptors, array $eventDescriptors): array
    {
        //Create map
        $map = new Map();

        //Create rooms
        foreach ($roomDescriptors as $roomDescriptor) {
            $roomDescription = $roomDescriptor->getDescription();
            $roomIndex = $roomDescriptor->getRoomIndex();
            $roomImage = $roomDescriptor->getRoomImage();
            $roomName = $roomDescriptor->getRoomName();
            $room = new Room($roomDescription, $roomIndex, $roomImage, $roomName);
            $room->setInventory(new Inventory());

            $map->addRoom($room, $roomIndex);
        }

        //Add inventories to rooms
        foreach ($itemDescriptors as $itemDescriptor) {
            $description = $itemDescriptor->getDescription();
            $name = $itemDescriptor->getName();
            $itemId = $itemDescriptor->getItemId();
            $placementDescription = $itemDescriptor->getPlacementDescription();
            $roomIndex = $itemDescriptor->getRoomIndex();
            $room = $map->getRoom($roomIndex);

            $item = new Item($description, $name, $itemId, $placementDescription);

            $room->getInventory()->addItem($item, $itemId);
        }

        //Add exits to rooms
        foreach ($exitDescriptors as $exitDescriptor) {
            $leadsToRoom = $exitDescriptor->getLeadsToRoom();
            $locatedInRoom = $exitDescriptor->getLocatedInRoom();
            $name = $exitDescriptor->getName();

            $roomContaining = $map->getRoom($locatedInRoom);

            $roomLeadsTo = $map->getRoom($leadsToRoom);

            $exit = new RoomExit($roomLeadsTo, $name);

            $roomContaining->addExit($exit);
        }

        //Create events from event descriptors

        $events = [];

        foreach ($eventDescriptors as $eventDescriptor) {
            $eventId = $eventDescriptor->getEvent();
            $description = $eventDescriptor->getDescription();
            $roomDescription = $eventDescriptor->getRoomDescription();
            $eventRoomIndex = $eventDescriptor->getEventRoom();
            $achievement = $eventDescriptor->getAchievement();
            $addExit = $eventDescriptor->getAddExit();

            $eventRoom = $map->getRoom($eventRoomIndex);

            $event = new Event($eventId, $description, $roomDescription, $eventRoom, $achievement);

            if ($addExit) {
                $leadsToRoom = $eventDescriptor->getExitLeadsTo();
                $isInRoom = $eventDescriptor->getExitIsInRoom();
                $exitName = $eventDescriptor->getExitName();


                $roomLeadsTo = $map->getRoom($leadsToRoom);

                $roomIsIn = $map->getRoom($isInRoom);

                $exit = new RoomExit($roomLeadsTo, $exitName);

                $event->setExit($exit);

                $event->setExitIsIn($roomIsIn);
            }

            $events[$eventId] = $event;
        }

        $this->setupObjects[] = $map;

        $this->setupObjects[] = $events;

        return $this->setupObjects;
    }
}
