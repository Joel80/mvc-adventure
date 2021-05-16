<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Room;


/**An interface for the actors in the adventure game */
Interface ActorInterface
{
    /**
     * Gets the room the actor is in
     * @return Room $currentRoom
     */
    public function getCurrentRoom();

    /**
     * Sets the  room the actor is in
     * @param $currentRoom the room the actor is in
     * @return Void
     */
    public function setCurrentRoom(Room $currentRoom);
}