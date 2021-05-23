<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Player;
use App\Adventure\Room;
use App\Adventure\RoomExit;
use App\Adventure\AdventureData;
use App\Adventure\Map;
use App\Entity\Achievement;
use App\Entity\AchievementLog;

/**
 * A class for managing the events of the game
 */
class AdventureEventManager
{
    /**
     * @var array $events Holds the events
     * @var Achievement|null Holds the last event
     * @var Achievement a holder that can hold an achievement set by an event
     */
    private array $events;
    private ?Achievement $lastAchievement;
    private Achievement $achievementHolder;

    /**
     * Constructor
     */
    public function __construct(array $events, Achievement $achievementHolder)
    {
        $this->events = $events;
        $this->achievementHolder = $achievementHolder;
        $this->lastAchievement = null;
    }

    /**
     * Sets last achievement
     * @param Achievement|null
     */
    public function setLastAchievement(?Achievement $achievement)
    {
        $this->lastAchievement = $achievement;
    }

    /**
     * Gets last achievement
     * @return Achievement|null
     */
    public function getLastAchievement(): ?Achievement
    {
        return $this->lastAchievement;
    }

    /**
     * Checks if an event has passed
     * @return void
     */
    public function checkEvent(string $itemId, string $roomIndex, Player $player): void
    {
        $eventString = $itemId . '&' . $roomIndex;

        $isEvent = array_key_exists($eventString, $this->events);

        if (!$isEvent) {
            $this->executeEventNone($player);
            return;
        }

        $event = $this->events[$eventString];

        $passed = $event->getPassed();

        if ($passed) {
            $this->executeEventNone($player);
            return;
        }

        $eventDescription = $event->getDescription();

        $playerRoom = $player->getCurrentRoom();

        $playerRoom->addTempDescription($eventDescription);

        $roomDescription = $event->getRoomDescription();

        $eventRoom = $event->getEventRoom();

        $eventRoom->setDescription($roomDescription);

        $exit = $event->getExit();

        $achievement = $event->getAchievement();

        if ($exit) {
            $room = $event->getExitIsIn();
            $room->addExit($exit);
        }

        if ($achievement) {
            $this->achievementHolder->setDescription($achievement);
            $this->setLastAchievement($this->achievementHolder);
            /* $this->lastAchievement = $this->achievementHolder; */
        }

        $event->setPassed(true);
    }

    /**
     * Executes the no event if there was no event
     * @param Player $player an instance of the Player class
     * @return void
     */
    public function executeEventNone(Player $player): void
    {
        $player
            ->getCurrentRoom()
            ->addTempDescription("Nothing happens")
        ;
    }
}
