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
use App\Adventure\AdventureEventManager;

class AdventureManager
{
    private AdventureData $data;
    private Map $map;
    private Player $player;
    private Log $log;
    private AdventureEventManager $eventManager;

    public function __construct(Player $player, AdventureData $data, Map $map, Log $log, AdventureEventManager $eventManager)
    {
        $this->player = $player;
        $this->data = $data;
        $this->map = $map;
        $this->lastEvent = null;
        $this->log = $log;
        $this->eventManager = $eventManager;
    }


     /**
      * TODO REMOVE
     * @param Room $roomToMoveTo
     */
    public function movePlayer(Room $roomToMoveTo): void
    {
        $this->player->setCurrentRoom($roomToMoveTo);
    }

    /**
     * TODO REMOVE
     */
    public function getCurrentPlayerRoom(): Room
    {
        return $this->player->getCurrentRoom();
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function getMap(): Map 
    {
        return $this->map;
    }

    public function getLog(): Log
    {
        return $this->log;
    }

    public function getAdventureEventManager(): getAdventureEventManager
    {
        return $this->eventManager;
    }

    /**
     * TODO REMOVE
     */
    public function getPlayerInventory(): Inventory
    {
        return $this->player->getInventory();
    }

    /**
     * TODO MOVE THESE METHODS TO OWN CLASS
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
}