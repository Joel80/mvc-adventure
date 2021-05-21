<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Room;


/**An interface for the actors in the adventure game */
class Player
{
    /**
     * @var Room $currentRoom the room the player is in
     * @var Room $formerRoom the room the player has left
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
     * @param $currentRoom the room the player is in
     * @return Void
     */
    public function setCurrentRoom(Room $currentRoom): void
    {
        $this->currentRoom = $currentRoom;
    }

    public function setInventory(Inventory $inventory): void
    {
        $this->inventory = $inventory;
    }

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }
}