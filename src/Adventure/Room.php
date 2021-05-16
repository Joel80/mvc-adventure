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
     * @var Inventory $inventory the rooms inventory
     * @var array $exits the exits from the room
     */

    private string $description;
    private array $tempDescriptions;
    private Inventory $inventory;
    private array $exits;
    private string $roomIndex;

    public function __construct(string $description, string $roomIndex)
    {
        $this->description = $description;
        $this->tempDescriptions = [];
        $this->roomIndex = $roomIndex;
        $this->exits = [];
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getTempDescriptions()
    {
        return $this->tempDescriptions;
    }

    public function addTempDescription(string $description)
    {
        $this->tempDescriptions[] = $description;
    }

    public function removeTempDescriptions()
    {
        $this->tempDescriptions = [];
    }

    public function setInventory(Inventory $inventory)
    {
        $this->inventory = $inventory;
    }

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    public function addExit(RoomExit $exit)
    {
        $this->exits[] = $exit;
    }

    public function getExits(): array
    {
        return $this->exits;
    }

    public function setRoomIndex(string $index): void
    {
        $this->roomIndex = $index;
    }

    public function getRoomIndex(): string
    {
        return $this->roomIndex;
    }
}