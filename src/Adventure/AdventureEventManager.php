<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Player;
use App\Adventure\Room;
use App\Adventure\RoomExit;
use App\Adventure\AdventureData;
use App\Adventure\Map;
use App\Entity\Event;
use App\Entity\Log;

class AdventureEventManager
{
    private array $eventFlags;

    private ?Event $lastEvent;

    public function __construct(int $nrOfEventFlags)
    {
        for ($i = 0; $i < $nrOfEventFlags; $i++) {
            $this->eventFlags[$i] = false;
        }

        $this->lastEvent = null;
    }

    public function setEventFlag(int $index, bool $value)
    {
        $this->eventFlags[$index] = $value;
    }

    public function getEventFlag(int $index)
    {
        return $this->eventFlags[$index];
    }

    public function setLastEvent(?Event $event)
    {
        $this->lastEvent = $event;
    }


    public function getLastEvent(): ?Event
    {
        return $this->lastEvent;
    }


    public function checkEvent(string $itemId, string $roomIndex, Map $map, Player $player)
    {
        $eventString = $itemId . '&' . $roomIndex;

        switch ($eventString) {
            case "idCard&roomOne" :
                $this->executeEventOne($map,$player);
            break;

            case "ironBar&roomOne" :
                $this->executeEventTwo($map, $player);
            break;

            case "dirtyClothRag&roomTwo" :
                $this->executeEventThree($map, $player);
            break;

            case "idCard&roomThree" :
                $this->executeEventFour($map, $player);
            break;

            case "1337&roomFive" :
                $this->executeEventFive($map, $player);
            break;

            default :
                $this->executeEventNone($player);
        }
    }

    public function executeEventOne(Map $map, Player $player)
    {
        $eventPassed = $this->getEventFlag(0);

        if ($eventPassed) {
            $this->executeEventNone($player);
            return;
        }

        $room = $map->getRoom("roomTwo");
        $exit = new RoomExit($room, "Northern Exit");

        $map
            ->getRoom("roomOne")
            ->addExit($exit);

        $newRoomDesc = $map
            ->getRoom("roomOnePostEv1")
            ->getDescription()
        ;

        $map
            ->getRoom("roomOne")
            ->setDescription($newRoomDesc)
        ;
        
        $map
            ->getRoom("roomOne")
            ->addTempDescription("You put the ID card in the slot by the door and the giant door swings open")
        ;

        $this->lastEvent = new Event();

        $this->lastEvent->setDescription("You opened the door in the Safe Room");

        $this->setEventFlag(0, true);
    }

    public function executeEventTwo(Map $map, Player $player)
    {
        $eventPassed = $this->getEventFlag(1);

        if ($eventPassed) {
            $this->executeEventNone($player);
            return;
        }

        $newRoomDesc = $map
            ->getRoom("roomOnePostEv2")
            ->getDescription()
        ;

        $map
            ->getRoom("roomOne")
            ->setDescription($newRoomDesc);
        
        $map
            ->getRoom("roomOne")
            ->addTempDescription("You use the iron bar to pry the locker door open. It is empty but someone has drawn a '1' on the wall inside.")
        ;

        $this->lastEvent = new Event();

        $this->lastEvent->setDescription("You opened the locker in the Safe Room");

        $this->setEventFlag(1, true);
    }

    public function executeEventThree(Map $map, Player $player)
    {
        $eventPassed = $this->getEventFlag(2);

        if ($eventPassed) {
            $this->executeEventNone($player);
            return;
        }

        $newRoomDesc = $map
            ->getRoom("roomTwoPostEv3")
            ->getDescription()
        ;

        $map
            ->getRoom("roomTwo")
            ->setDescription($newRoomDesc);
        
        $map
            ->getRoom("roomTwo")
            ->addTempDescription("You use the dirty cloth rag to wipe away the water in the middle of the floor. Someone has etched a '3' here.")
        ;

        $this->lastEvent = new Event();

        $this->lastEvent->setDescription("You removed the water in the Hallway");

        $this->setEventFlag(2, true);
    }

    public function executeEventFour(Map $map, Player $player)
    {
        $eventPassed = $this->getEventFlag(3);

        if ($eventPassed) {
            $this->executeEventNone($player);
            return;
        }

        $newRoomDesc = $map
            ->getRoom("roomThreePostEv4")
            ->getDescription()
        ;

        $map
            ->getRoom("roomThree")
            ->setDescription($newRoomDesc);
        
        $map
            ->getRoom("roomThree")
            ->addTempDescription("You use the ID card on a small reader next to the computer. The screen flickers and you can here a voice repeating 'Zzzz exit code zz3z'. 
                It is hard to hear the message among all the static.")
            ;

        $this->lastEvent = new Event();

        $this->lastEvent->setDescription("You turned on the computer in the Surveilance Room");

        $this->setEventFlag(3, true);
    }

    public function executeEventFive(Map $map, Player $player)
    {
        $eventPassed = $this->getEventFlag(4);

        if ($eventPassed) {
            $this->executeEventNone($player);
            return;
        }

        $room = $map->getRoom("roomSix");
        
        $exit = new RoomExit($room, "Vault door");

        $map
            ->getRoom("roomFive")
            ->addExit($exit)
        ;

        $newRoomDesc = $map
            ->getRoom("roomFivePostEv5")
            ->getDescription()
        ;

        $map
            ->getRoom("roomFive")
            ->setDescription($newRoomDesc);
        
        $map
            ->getRoom("roomFive")
            ->addTempDescription("You enter the code on the keypad next to the door and the great vault door swings open with a rumbling sound.")
        ;

        $this->lastEvent = new Event();

        $this->lastEvent->setDescription("You opened the vault door");

        $this->setEventFlag(4, true);
    }

    public function executeEventNone(Player $player)
    {
        $player
            ->getCurrentRoom()
            ->addTempDescription("Nothing happens")
        ;
    }

}