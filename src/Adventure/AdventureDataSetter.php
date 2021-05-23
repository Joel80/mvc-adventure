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

/**
 * A class with methods that prepares data and calls AdventureData to set the data
 */
class AdventureDataSetter
{
    /**
     * @var AdventureData $data holds an instance of AdventureData
     * @var Player $player holds an instance of Player
     */
    private AdventureData $data;
    private Player $player;

    /**
     * Constructor
     */
    public function __construct(AdventureData $data, Player $player)
    {
        $this->data = $data;
        $this->player = $player;
    }

    /**
     * Sets data by calling the set methods of this class
     * @return void
     */
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

    /**
     * Prepares and sets the room description data
     * @return void
     */
    public function setCurrentPlayerRoomDescriptionData(): void
    {
        $room = $this->player->getCurrentRoom();

        $roomDescription = $room->getDescription();

        $this->data->setPlayerRoomDescriptionData($roomDescription);
    }

    /**
     * Prepares and sets the room image data
     * @return void
     */
    public function setCurrentPlayerRoomImageData(): void
    {
        $room = $this->player->getCurrentRoom();

        $roomImage = $room->getRoomImageUrl();

        $this->data->setPlayerRoomImageData($roomImage);
    }

    /**
     * Prepares and sets the room name data
     * @return void
     */
    public function setCurrentPlayerRoomNameData(): void
    {
        $room = $this->player->getCurrentRoom();

        $roomName = $room->getRoomName();

        $this->data->setPlayerRoomNameData($roomName);
    }

    /**
     * Prepares and sets the room exit(s) data
     * @return void
     */
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

    /**
     * Prepares and sets the room items data
     * @return void
     */
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

    /**
     * Prepares and sets the player item data
     * @return void
     */
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

    /**
     * Prepares and sets the room index data
     * @return void
     */
    public function setCurrentPlayerRoomIndexData()
    {
        $currentRoomIndex = $this->player->getCurrentRoom()->getRoomIndex();
        $this->data->setPlayerRoomIndexData($currentRoomIndex);
    }

    /**
     * Prepares and sets the room temporary description data
     * @return void
     */
    public function setCurrentPlayerRoomTempDescriptionsData()
    {

        $tempDescriptions = $this->player->getCurrentRoom()->getTempDescriptions();
        $this->data->setPlayerRoomTempDescriptionsData($tempDescriptions);
    }

    /**
     * Gets the data from AdventureData
     * @return array with the data
     */
    public function getAdventureData(): array
    {
        return $this->data->getAdventureData();
    }
}
