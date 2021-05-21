<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Room;
use App\Adventure\RoomExit;


class Event
{
    private string $eventId;
    private string $description;
    private string $roomDescription;
    private ?RoomExit $exit;
    private ?Room $exitIsIn;
    private Room $eventRoom;
    private bool $passed;
    private ?string $achievement;

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

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getRoomDescription(): string
    {
        return $this->roomDescription;
    }

    public function getEventRoom(): Room
    {
        return $this->eventRoom;
    }

    public function getExit(): ?RoomExit
    {
        return $this->exit;
    }

    public function setExit(RoomExit $exit): void
    {
        $this->exit = $exit;
    }

    public function getExitIsIn(): ?Room
    {
        return $this->exitIsIn;
    }

    public function setExitIsIn(?Room $exitIsIn): void
    {
        $this->exitIsIn = $exitIsIn;
    }

    public function getPassed(): bool
    {
        return $this->passed;
    }

    public function setPassed(bool $value): void
    {
        $this->passed = $value;
    }

    public function getAchievement(): ?string
    {
        return $this->achievement;
    }
}