<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Player;
use App\Adventure\Room;
use App\Adventure\RoomExit;
/* use App\Adventure\AdventureData; */
use App\Adventure\Map;
/* use App\Entity\Event;
use App\Entity\Log; */
use App\Entity\Achievement;
use App\Entity\AchievementLog;
use App\Entity\RoomVisitLog;
use App\Adventure\AdventureEventManager;
use App\Adventure\AdventureDataSetter;

class AdventureManager
{
   /*  private AdventureData $data; */
    private Map $map;
    private Player $player;
    private AchievementLog $achievementLog;
    private RoomVisitLog $roomVisitLog;
    private AdventureEventManager $eventManager;
    private AdventureDataSetter $dataSetter;

    public function __construct(Player $player, AdventureDataSetter $adventureDataSetter, Map $map, AchievementLog $achievementLog, AdventureEventManager $eventManager, RoomVisitLog $roomVisitLog)
    {
        $this->player = $player;
        $this->dataSetter = $adventureDataSetter;
        $this->map = $map;
        $this->lastEvent = null;
        $this->achievementLog = $achievementLog;
        $this->roomVisitLog = $roomVisitLog;
        $this->eventManager = $eventManager;
    }

    public function getAdventureDataSetter(): AdventureDataSetter
    {
        return $this->dataSetter;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function getMap(): Map 
    {
        return $this->map;
    }

    public function getAchievementLog(): AchievementLog
    {
        return $this->achievementLog;
    }

    public function getRoomVisitLog(): RoomVisitLog
    {
        return $this->roomVisitLog;
    }

    public function getAdventureEventManager(): AdventureEventManager
    {
        return $this->eventManager;
    }
}