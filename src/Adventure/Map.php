<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Room;

/**A class for the map in the adventure game */
class Map
{
    /**
     * @var array $map holds the rooms in the game
     */
    private array $map;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->map = [];
    }

    /**
     * Adds a room to the map
     * @param Room $room to add
     * @param string $index to add the room at
     * @return void
     */
    public function addRoom(Room $room, string $index): void
    {
        $this->map[$index] = $room;
    }

    /**
     * Gets the map array
     * @return array the map array
     */
    public function getMap(): array
    {
        return $this->map;
    }

    /**
     * Gets a room from the map
     * @param string $index the index for the room
     * @return Room the room at the index
     */
    public function getRoom(string $index): Room
    {
        return $this->map[$index];
    }
}
