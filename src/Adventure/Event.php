<?php

declare(strict_types=1);

namespace App\Adventure;


class Event
{
    private string $eventId;
    private string $description;

    public function __construct(string $eventId, string $description)
    {
        $this->eventId = $eventId;
        $this->description = $description;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}