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

class AdventureManager
{
    private AdventureData $data;
    private Map $map;
    private Player $player;
    private ?Event $lastEvent;
    private Log $log;
    private bool $event1;
    private bool $event2;
    private bool $event3;
    private bool $event4;
    private bool $event5;

    public function __construct(Player $player, AdventureData $data, Map $map, Log $log)
    {
        $this->player = $player;
        $this->data = $data;
        $this->map = $map;
        $this->lastEvent = null;
        $this->log = $log;
        $this->event1 = false;
        $this->event2 = false;
        $this->event3 = false;
        $this->event4 = false;
        $this->event5 = false;
    }


     /**
     * @param Room $roomToMoveTo
     */
    public function movePlayer(Room $roomToMoveTo): void
    {
        $this->player->setCurrentRoom($roomToMoveTo);
    }

    public function getCurrentPlayerRoom(): Room
    {
        return $this->player->getCurrentRoom();
    }

    /**
     * 
     */
    public function getPlayerInventory(): Inventory
    {
        return $this->player->getInventory();
    }

    /**
     * 
     */
    public function setCurrentPlayerRoomDescriptionData(): void
    {
        $room = $this->player->getCurrentRoom();

        $roomDescription = $room->getDescription();

        $this->data->setPlayerRoomDescriptionData($roomDescription);
    }

    public function setCurrentPlayerRoomImageData(): void
    {
        $room = $this->player->getCurrentRoom();

        $roomImage = $room->getRoomImageUrl();

        $this->data->setPlayerRoomImageData($roomImage);
    }

    public function setCurrentPlayerRoomNameData(): void
    {
        $room = $this->player->getCurrentRoom();

        $roomName = $room->getRoomName();

        $this->data->setPlayerRoomNameData($roomName);
    }

    public function setCurrentPlayerRoomExitsData(): void
    {
        $exitsData = [];

        $room = $this->player->getCurrentRoom();

        $exits = $room->getExits();

        foreach ($exits as $exit)
        {

            $exitName = $exit->getExitName();

            $exitRoom = $exit->getRoomExitLeadsTo();
            
            $roomIndex= $exitRoom->getRoomIndex();

            $exitsData[$exitName] = $roomIndex;

        }

        $this->data->setPlayerRoomExits($exitsData);
    }

    public function setCurrentPlayerRoomItemsData(): void
    {
        $room = $this->player->getCurrentRoom();

        $inventory = $room->getInventory();

        $items = $inventory->getItems();

        $roomItems = [];

        foreach ($items as $item)
        {

            $currentItem = [];

            $itemId = $item->getItemId();

            $currentItem['id'] = $itemId;

            $itemName = $item->getName();
            $currentItem['name'] = $itemName;

            $itemDescription = $item->getDescription();
            $currentItem['description'] = $itemDescription;

            $itemPlacementDescription = $item->getPlacementDescription();
            $currentItem["placementDescription"] = $itemPlacementDescription;

            array_push($roomItems, $currentItem);
        }

        $this->data->setPlayerRoomItemsData($roomItems);
    }

    public function setPlayerItemsData()
    {
        $inventory =$this->player->getInventory();

        $items = $inventory->getItems();

        $playerItems = [];

        foreach ($items as $item)
        {

            $currentItem = [];

            $itemId = $item->getItemId();

            $currentItem['id'] = $itemId;

            $itemName = $item->getName();
            $currentItem['name'] = $itemName;

            $itemDescription = $item->getDescription();
            $currentItem['description'] = $itemDescription;

            array_push($playerItems, $currentItem);
        }

        $this->data->setPlayerItemsData($playerItems);

    }

    public function setCurrentPlayerRoomIndexData()
    {
        $currentRoomIndex = $this->getCurrentPlayerRoom()->getRoomIndex();
        $this->data->setPlayerRoomIndexData($currentRoomIndex);
    }

    public function setCurrentPlayerRoomTempDescriptionsData()
    {
        
       $tempDescriptions = $this->getCurrentPlayerRoom()->getTempDescriptions();
       $this->data->setPlayerRoomTempDescriptionsData($tempDescriptions);
    }

    public function getAdventureData()
    {
        return $this->data->getAdventureData();
    }

    public function getRoomFromMap(string $roomIndex): Room
    {
        return $this->map->getRoom($roomIndex);
    }

    public function getLastEvent()
    {
        return $this->lastEvent;
    }

    public function getLog()
    {
        return $this->log;
    }

    public function setLastEvent(?Event $lastEvent)
    {
        $this->lastEvent = $lastEvent;
    }

    public function getEvent1()
    {
        return $this->event1;
    }

    public function setEvent1(bool $value)
    {
        $this->event1 = $value;
    }

    public function getEvent2()
    {
        return $this->event2;
    }

    public function setEvent2(bool $value)
    {
        $this->event2 = $value;
    }

    public function getEvent3()
    {
        return $this->event3;
    }

    public function setEvent3(bool $value)
    {
        $this->event3 = $value;
    }

    public function getEvent4()
    {
        return $this->event4;
    }

    public function setEvent4(bool $value)
    {
        $this->event4 = $value;
    }

    public function getEvent5()
    {
        return $this->event5;
    }

    public function setEvent5(bool $value)
    {
        $this->event5 = $value;
    }

    public function checkItemUse(string $itemId, string $roomIndex)
    {
        if ($itemId == "idCard" && $roomIndex == "roomOne" && !$this->event1)
        {
            $room = $this->getRoomFromMap("roomTwo");
            $exit = new RoomExit($room, "North Exit");

            $this
                ->getRoomFromMap("roomOne")
                ->addExit($exit);

            $this
                ->getRoomFromMap("roomOne")
                ->setDescription("You are in in a room filled with debris. Beds, desks, and overturned chairs litter the room. 
                Severed cables hangs from the ceiling. Red flashing emergency light fills the room and you can see a small 
                locker in one corner of the room. The locker door is slightly ajar but seems jammed.  A fallen exit sign lies on the floor. The door to the north is open");
            
            $this
                ->getRoomFromMap("roomOne")
                ->addTempDescription("You put the ID card in the slot by the door and the giant door swings open");

            $event = new Event();

            $event->setDescription("You opened the door in the Safe Room");

            $this->setLastEvent($event);

            $this->setEvent1(true);
            
            return;
        }

        if ($itemId == "ironBar" && $roomIndex == "roomOne" && !$this->event2)
        {
            $room = $this->getRoomFromMap("roomTwo");
            $exit = new RoomExit($room, "Northern Exit");

            $this
                ->getRoomFromMap("roomOne")
                ->addExit($exit);

            $this
                ->getRoomFromMap("roomOne")
                ->setDescription("You are in in a room filled with debris. Beds, desks and overturned chairs litter the room. 
                Severed cables hangs from the ceiling. Red flashing emergency light fills the room and you can see a small
                locker in one corner of the room. The locker door is open and you can see the number '1' drawn on the wall inside.
                A fallen exit sign lies on the floor.The door to the north is open");
            
            $this
                ->getRoomFromMap("roomOne")
                ->addTempDescription("You use the the iron bar to pry the locker door open. It is empty but someone has drawn a '1' on the wall inside.");
            

            $event = new Event();

            $event->setDescription("You opened the locker in the Safe Room");

            $this->setLastEvent($event);

            $this->setEvent2(true);
            
            return;
        }

        if ($itemId == "dirtyClothRag" && $roomIndex == "roomTwo" && !$this->event3)
        {
            $this
                ->getRoomFromMap("roomTwo")
                ->setDescription("This hallway is lit only by the flashing red light from the room to the south. Dust covers the floor.
                Someone has etched a '3' in the middle of the floor. There is an exit to the south and an exit to the east.");
            
            $this
                ->getRoomFromMap("roomTwo")
                ->addTempDescription("You use the dirty cloth rag to wipe away the water in the middle of the floor. Someone has etched a '3' here.");
            
            $this->setEvent3(true);

            $event = new Event();

            $event->setDescription("You removed the water in the Hallway");

            $this->setLastEvent($event);

            $this->setEvent2(true);

            return;
        }

        if ($itemId == "idCard" && $roomIndex == "roomThree" && !$this->event4)
        {
            $this
                ->getRoomFromMap("roomThree")
                ->setDescription("This room seems to get it's power from another power source. It is dark but a small computer on
                a desk in the corner seems to be working. The screen flickers and you can here a voice repeating 'Zzzz exit code zz3z'. 
                It is hard to hear the message among all the static.");
            
            $this
                ->getRoomFromMap("roomThree")
                ->addTempDescription("You use the ID card on a small reader next to the computer. The screen flickers and you can here a voice repeating 'Zzzz exit code zz3z'. 
                It is hard to hear the message among all the static.");

            $event = new Event();

            $event->setDescription("You turned on the computer in the Surveilance Room");

            $this->setLastEvent($event);
            $this->setEvent4(true);

            return;
        }

        if ($itemId == "1337" && $roomIndex == "roomFive" && !$this->event5)
        {
            $room = $this->getRoomFromMap("roomSix");
            $exit = new RoomExit($room, "Vault door");

            $this
                ->getRoomFromMap("roomFive")
                ->addExit($exit);
            $this
                ->getRoomFromMap("roomFive")
                ->setDescription("The power seems to be working in this this great hall. It basks in flickering yellow light. The great vault door on the north wall is open. 
                There is an exit to the south. To the north lies the exit to the rest of the world and maybe freedom?");
            
            $this
                ->getRoomFromMap("roomFive")
                ->addTempDescription("You enter the code on the keypad next to the door and the great vault door swings open with a rumbling sound.");
            

            $event = new Event();

            $event->setDescription("You opened the vault door");

            $this->setLastEvent($event);

            $this->setEvent5(true);

            return;
        }

        $this->getCurrentPlayerRoom()->addTempDescription("Nothing happens");
        return;
    }

}