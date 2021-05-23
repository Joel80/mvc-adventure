<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Player;
use App\Adventure\Room;
use App\Adventure\RoomExit;
use App\Adventure\AdventureData;
use App\Adventure\Map;
/* use App\Entity\Event;
use App\Entity\Log; */
use App\Entity\Achievement;
use App\Entity\AchievementLog;
use App\Adventure\AdventureEventManager;

class AdventureDataSetter
{
    private AdventureData $data;
    private Player $player;

    public function __construct(AdventureData $data, Player $player)
    {
        $this->data = $data;
        $this->player = $player;
    }

    public function setData(): void
    {
        $this->setCurrentPlayerRoomDescriptionData();

        $this->setCurrentPlayerRoomExitsData();

        $this->setCurrentPlayerRoomItemsData();

        $this->setPlayerItemsData();

        $this->setCurrentPlayerRoomIndexData();

        $this->setCurrentPlayerRoomTempDescriptionsData();

        $this->setCurrentPlayerRoomImageData();

        $this->setCurrentPlayerRoomNameData();
    }

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

        foreach ($exits as $exit) {
            $exitName = $exit->getExitName();

            $exitRoom = $exit->getRoomExitLeadsTo();

            $roomIndex = $exitRoom->getRoomIndex();

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

        foreach ($items as $item) {
            $currentItem = [];

            $itemId = $item->getItemId();

            $currentItem['id'] = $itemId;

            $itemName = $item->getName();
            $currentItem['name'] = $itemName;

            $itemDescription = $item->getDescription();
            $currentItem['description'] = $itemDescription;

            $itemPlacement = $item->getPlacementDescription();
            $currentItem["placementDescription"] = $itemPlacement;

            array_push($roomItems, $currentItem);
        }

        $this->data->setPlayerRoomItemsData($roomItems);
    }

    public function setPlayerItemsData()
    {
        $inventory = $this->player->getInventory();

        $items = $inventory->getItems();

        $playerItems = [];

        foreach ($items as $item) {
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
        $currentRoomIndex = $this->player->getCurrentRoom()->getRoomIndex();
        $this->data->setPlayerRoomIndexData($currentRoomIndex);
    }

    public function setCurrentPlayerRoomTempDescriptionsData()
    {

        $tempDescriptions = $this->player->getCurrentRoom()->getTempDescriptions();
        $this->data->setPlayerRoomTempDescriptionsData($tempDescriptions);
    }

    public function getAdventureData()
    {
        return $this->data->getAdventureData();
    }
}
