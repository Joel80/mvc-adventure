<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Inventory;
use App\Adventure\RoomExit;

/**A class for the rooms in the adventure game */
class Room
{
    /**
     * @var string $description the room description
     * @var array $tempDescriptions holds temporary descriptions (events)
     * @var Inventory $inventory the rooms inventory
     * @var array $exits the exits from the room
     * @var string $roomIndex the rooms index
     * @var string $imageUrl the url to the rooms image
     * @var string $name the rooms name
     */

    private string $description;
    private array $tempDescriptions;
    private Inventory $inventory;
    private array $exits;
    private string $roomIndex;
    private string $imageUrl;
    private string $name;

    /**
     * Constructor
     * @param string $description the room description
     * @param string $roomIndex the rooms index
     * @param string $imageUrl the url to the rooms image
     * @param string $name the rooms name
     */
    public function __construct(string $description, string $roomIndex, string $imageUrl, string $name)
    {
        $this->description = $description;
        $this->tempDescriptions = [];
        $this->roomIndex = $roomIndex;
        $this->exits = [];
        $this->imageUrl = $imageUrl;
        $this->name = $name;
    }

    /**
     * Gets the room description
     * @return string the description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the room description
     * @param string $description the description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Gets the room temporary descriptions
     * @return array with the descriptions
     */
    public function getTempDescriptions(): array
    {
        return $this->tempDescriptions;
    }

    /**
     * Adds a description to the temporary descriptions
     * @param string $description the description to add
     * @return void
     */
    public function addTempDescription(string $description): void
    {
        $this->tempDescriptions[] = $description;
    }

    /**
     * Unsets the temporary descriptions
     * @return void
     */
    public function removeTempDescriptions(): void
    {
        $this->tempDescriptions = [];
    }

    /**
     * Sets the room inventory
     * @param Inventory $inventory the new inventory
     * @return void
     */
    public function setInventory(Inventory $inventory): void
    {
        $this->inventory = $inventory;
    }

    /**
     * Gets the room inventory
     * @return Inventory the inventory
     */
    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    /**
     * Adds an exit to the room
     * @param RoomExit $exit the exit to add
     * @return void
     */
    public function addExit(RoomExit $exit): void
    {
        $this->exits[] = $exit;
    }

    /**
     * Gets the room exits
     * @return array with the exits
     */
    public function getExits(): array
    {
        return $this->exits;
    }

    /**
     * Sets the room index
     * @param string $index the index
     * @return void
     */
    public function setRoomIndex(string $index): void
    {
        $this->roomIndex = $index;
    }

    /**
     * Gets the room index
     * @return string the index
     */
    public function getRoomIndex(): string
    {
        return $this->roomIndex;
    }
    
    /**
     * Sets the room image url
     * @param string $imageUrl the url to the image
     * @return void
     */
    public function setRoomImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * Gets the room image url
     * @return string the url
     */
    public function getRoomImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * Sets the room name
     * @param string $name the name
     * @return void
     */
    public function setRoomName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Gets the room name
     * @return string the name
     */
    public function getRoomName(): string
    {
        return $this->name;
    }
}
