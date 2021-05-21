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
    private string $imageUrl;
    private string $name;

    public function __construct(string $description, string $roomIndex, string $imageUrl, string $name)
    {
        $this->description = $description;
        $this->tempDescriptions = [];
        $this->roomIndex = $roomIndex;
        $this->exits = [];
        $this->imageUrl = $imageUrl;
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getTempDescriptions(): array
    {
        return $this->tempDescriptions;
    }

    public function addTempDescription(string $description): void
    {
        $this->tempDescriptions[] = $description;
    }

    public function removeTempDescriptions(): void
    {
        $this->tempDescriptions = [];
    }

    public function setInventory(Inventory $inventory): void
    {
        $this->inventory = $inventory;
    }

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    public function addExit(RoomExit $exit): void
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

    public function setRoomImageUrl(string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function getRoomImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setRoomName(string $name): void
    {
        $this->name = $name;
    }

    public function getRoomName(): string
    {
        return $this->name;
    }
}