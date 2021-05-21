<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Room;

/**A class for the map in the adventure game */
class Map
{
    private array $map;

    public function __construct()
    {
        $this->map = [];
    }

    public function addRoom(Room $room, string $index): void
    {
        $this->map[$index] = $room;
    }

    public function getMap(): array
    {
        return $this->map;
    }

    public function getRoom(string $index): Room 
    {
        return $this->map[$index];
    }
}
