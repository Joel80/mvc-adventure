<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Room;

/**A class for the exits of the rooms in the adventure game */
class RoomExit
{
    /**
     * @var Room $roomExitLeadsTo the room the exit leads to
     * @var string $exitName the name of the exit
     */
    private Room $roomExitLeadsTo;
    private string $exitName;

    /**
     * Constructor
     * @param Room $roomExitLeadsTo the room the exit leads to
     */
    public function __construct(Room $roomExitLeadsTo, string $name)
    {
        $this->roomExitLeadsTo = $roomExitLeadsTo;
        $this->exitName = $name;
    }

    public function getRoomExitLeadsTo(): Room
    {
        return $this->roomExitLeadsTo;
    }

    public function getExitName(): string
    {
        return $this->exitName;
    }
}
