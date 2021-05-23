<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Room;

/**A player class for the adventure game */
class Player
{
    /**
     * @var Room $currentRoom the room the player is in
     * @var Inventory $inventory the players inventory
     *
     */
    private Room $currentRoom;
    private Inventory $inventory;

    public function __construct(Room $startingRoom)
    {
        $this->currentRoom = $startingRoom;
    }

    /**
     * Gets the room the player is in
     * @return Room $currentRoom
     */
    public function getCurrentRoom(): Room
    {
        return $this->currentRoom;
    }

    /**
     * Sets the  room the player is in
     * @param Room $currentRoom the room the player is in
     * @return void
     */
    public function setCurrentRoom(Room $currentRoom): void
    {
        $this->currentRoom = $currentRoom;
    }

    /**
     * Sets the players inventory
     * @param Inventory $inventory the players new inventory
     * @return void
     */
    public function setInventory(Inventory $inventory): void
    {
        $this->inventory = $inventory;
    }

    /**
     * Gets the players inventory
     * @return Inventory the players inventory
     */
    public function getInventory(): Inventory
    {
        return $this->inventory;
    }
}
