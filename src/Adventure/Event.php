<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Room;
use App\Adventure\RoomExit;

/**
 * A class for the events in the game
 */
class Event
{
    /**
     * @var string $eventId the id of the event
     * @var string $description of the event
     * @var string $roomDescription holds a new room description that can be used
     * to change the description of a room.
     * @var RoomExit|null $exit can hold an exit that "opens" because of the event
     * @var Room|null $exitIsIn the room the new exit is placed in
     * @var Room|null $exitLeadsTo the room the new exit leads to
     * @var Room $eventRoom the room the event takes place in
     * @var bool $passed flag marking if event has passed or not
     * @var string|null $achievement holds text for an achievement connected to the event
     */
    private string $eventId;
    private string $description;
    private string $roomDescription;
    private ?RoomExit $exit;
    private ?Room $exitIsIn;
    private Room $eventRoom;
    private bool $passed;
    private ?string $achievement;

    /**
     * Constructor
     * @param string $eventId the id of the event
     * @param string $description of the event
     * @param string $roomDescription holds a new room description that can be used
     * to change the description of a room.
     * @param Room $eventRoom the room the event takes place in
     * @param string $achievement holds text for an achievement connected to the event
     */
    public function __construct(string $eventId, string $description, string $roomDescription, Room $eventRoom, string $achievement)
    {
        $this->eventId = $eventId;
        $this->description = $description;
        $this->roomDescription = $roomDescription;
        $this->eventRoom = $eventRoom;
        $this->achievement = $achievement;
        $this->passed = false;
        $this->exit = null;
        $this->exitIsIn = null;
    }

    /**
     * Gets the event id
     * @return string the event id
     */
    public function getEventId(): string
    {
        return $this->eventId;
    }

    /**
     * Gets the description
     * @return string the description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Gets the room description
     * @return string the room description
     */
    public function getRoomDescription(): string
    {
        return $this->roomDescription;
    }

    /**
     * Gets the event
     * @return Room the event room
     */
    public function getEventRoom(): Room
    {
        return $this->eventRoom;
    }

    /**
     * Gets the room exit
     * @return RoomExit|null the room exit
     */
    public function getExit(): ?RoomExit
    {
        return $this->exit;
    }

    /**
     * Sets the room exit
     * @return void
     */
    public function setExit(RoomExit $exit): void
    {
        $this->exit = $exit;
    }

    /**
     * Gets the room the exit is in
     * @return Room|null the room
     */
    public function getExitIsIn(): ?Room
    {
        return $this->exitIsIn;
    }

    /**
     * Sets the room the exit is in
     * @param Room|null $exitIsIn the room the exit is in
     * @return void
     */
    public function setExitIsIn(?Room $exitIsIn): void
    {
        $this->exitIsIn = $exitIsIn;
    }

    /**
     * Gets the passed flag
     * @return bool the flag
     */
    public function hasPassed(): bool
    {
        return $this->passed;
    }

    /**
     * Sets the passed flag
     * @param bool $value the value to set
     * @return void
     */
    public function setPassed(bool $value): void
    {
        $this->passed = $value;
    }

    /**
     * Gets the achievement string
     * @return string|null the achievement string
     */
    public function getAchievement(): ?string
    {
        return $this->achievement;
    }
}
