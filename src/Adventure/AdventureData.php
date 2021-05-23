<?php

declare(strict_types=1);

namespace App\Adventure;

class AdventureData
{
    private array $data;

    public function __construct()
    {
    }

    public function setPlayerRoomDescriptionData(string $description): void
    {
        $this->data['playerRoomDescription'] = $description;
    }

    public function setPlayerRoomImageData(string $roomImage): void
    {
        $this->data['playerRoomImage'] = $roomImage;
    }

    public function setPlayerRoomNameData(string $roomName): void
    {
        $this->data['playerRoomName'] = $roomName;
    }

    /* public function setPlayerRoomExitsNameData(array $exitNames): void
    {
        $this->data['playerRoomExitNameData'] = $exitNames;
    } */

    public function setPlayerRoomExits(array $exits): void
    {
        $this->data['playerRoomExits'] = $exits;
    }

    public function setPlayerRoomItemsData(array $roomItems): void
    {
        $this->data['playerRoomItems'] = $roomItems;
    }

    public function setPlayerItemsData(array $playerItems): void
    {
        $this->data['playerItems'] = $playerItems;
    }

    public function setPlayerRoomIndexData(string $currentRoomIndex): void
    {
        $this->data['playerRoomIndex'] = $currentRoomIndex;
    }

    public function setPlayerRoomTempDescriptionsData(array $tempDescriptions): void
    {
        $this->data['playerRoomTempDescriptions'] = $tempDescriptions;
    }

    public function getAdventureData()
    {
        return $this->data;
    }
}
