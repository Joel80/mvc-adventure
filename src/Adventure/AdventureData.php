<?php

declare(strict_types=1);

namespace App\Adventure;

/**
 * A class holding the game data
 */
class AdventureData
{
    /**
    * @var array $data Holds the game data
    */
    private array $data;

    public function __construct()
    {
    }

    /**
     * Sets data for the roomdescription in $data
     * @return void
     */
    public function setPlayerRoomDescriptionData(string $description): void
    {
        $this->data['playerRoomDescription'] = $description;
    }

    /**
     * Sets data for the room image in $data
     * @return void
     */
    public function setPlayerRoomImageData(string $roomImage): void
    {
        $this->data['playerRoomImage'] = $roomImage;
    }

    /**
     * Sets data for the room name in $data
     * @return void
     */
    public function setPlayerRoomNameData(string $roomName): void
    {
        $this->data['playerRoomName'] = $roomName;
    }

    /**
     * Sets data for the room exits in $data
     * @return void
     */
    public function setPlayerRoomExits(array $exits): void
    {
        $this->data['playerRoomExits'] = $exits;
    }

    /**
     * Sets data for the room items in $data
     * @return void
     */
    public function setPlayerRoomItemsData(array $roomItems): void
    {
        $this->data['playerRoomItems'] = $roomItems;
    }

    /**
     * Sets data for players items in $data
     * @return void
     */
    public function setPlayerItemsData(array $playerItems): void
    {
        $this->data['playerItems'] = $playerItems;
    }

    /**
     * Sets data for the room index in $data
     * @return void
     */
    public function setPlayerRoomIndexData(string $currentRoomIndex): void
    {
        $this->data['playerRoomIndex'] = $currentRoomIndex;
    }

    /**
     * Sets data for the temporary descriptions (events) in $data
     * @return void
     */
    public function setPlayerRoomTempDescriptionsData(array $tempDescriptions): void
    {
        $this->data['playerRoomTempDescriptions'] = $tempDescriptions;
    }

    /**
     * Gets $data
     * @return array the $data array
     */
    public function getAdventureData(): array
    {
        return $this->data;
    }
}
