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

class AdventureEventManager
{
    private array $events;
    private ?Achievement $lastAchievement;
    private Achievement $achievementHolder;

    public function __construct(array $events, Achievement $achievementHolder)
    {
        $this->events = $events;
        $this->achievementHolder = $achievementHolder;
        $this->lastAchievement = null;
    }

    public function setLastAchievement(?Achievement $achievement)
    {
        $this->lastAchievement = $achievement;
    }

    public function getLastAchievement(): ?Achievement
    {
        return $this->lastAchievement;
    }

    public function checkEvent(string $itemId, string $roomIndex, Player $player)
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

    public function executeEventNone(Player $player)
    {
        $player
            ->getCurrentRoom()
            ->addTempDescription("Nothing happens")
        ;
    }
}
