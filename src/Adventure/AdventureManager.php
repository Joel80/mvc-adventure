<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Player;
use App\Adventure\Room;
use App\Adventure\RoomExit;
use App\Adventure\Map;
use App\Entity\Achievement;
use App\Entity\AchievementLog;
use App\Entity\RoomVisitLog;
use App\Adventure\AdventureEventManager;
use App\Adventure\AdventureDataSetter;

/**
 * A class that holds other classes and manages the game
 */
class AdventureManager
{
    /**
     * @var Map $map the game map that holds the rooms
     * @var Player $player holds an instance of Player
     * @var AchievementLog $achievementLog holds the achievementLog
     * @var RoomVisitLog $roomVisitLog holds the roomvisitLog
     * @var AdventureEventManager $eventManager holds the eventmanager
     * @var AdventureDataSetter $dataSetter holds the games datasetter
     */
    private Map $map;
    private Player $player;
    private AchievementLog $achievementLog;
    private RoomVisitLog $roomVisitLog;
    private AdventureEventManager $eventManager;
    private AdventureDataSetter $dataSetter;

    /**
     * Constructur
     * @param Map $map the game map that holds the rooms
     * @param Player $player holds an instance of Player
     * @param AchievementLog $achievementLog holds the achievementLog
     * @param RoomVisitLog $roomVisitLog holds the roomvisitLog
     * @param AdventureEventManager $eventManager holds the eventmanager
     * @param AdventureDataSetter $adventureDataSetter holds the games datasetter
     */
    public function __construct(Player $player, AdventureDataSetter $adventureDataSetter, Map $map, AchievementLog $achievementLog, AdventureEventManager $eventManager, RoomVisitLog $roomVisitLog)
    {
        $this->player = $player;
        $this->dataSetter = $adventureDataSetter;
        $this->map = $map;
        //$this->lastEvent = null;
        $this->achievementLog = $achievementLog;
        $this->roomVisitLog = $roomVisitLog;
        $this->eventManager = $eventManager;
    }

    /**
     * Gets the adventureDataSetter
     * @return AdventureDataSetter the games AdventureDatasetter
     */
    public function getAdventureDataSetter(): AdventureDataSetter
    {
        return $this->dataSetter;
    }

    /**
     * Gets the player
     * @return Player the games Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * Gets the map
     * @return Map the games map
     */
    public function getMap(): Map
    {
        return $this->map;
    }

    /**
     * Gets the achievement log
     * @return AchievementLog the games achievement log
     */
    public function getAchievementLog(): AchievementLog
    {
        return $this->achievementLog;
    }

    /**
     * Gets the room visitlog
     * @return RoomVisitLog the games roomvisit log
     */
    public function getRoomVisitLog(): RoomVisitLog
    {
        return $this->roomVisitLog;
    }

    /**
     * Gets the eventmanager
     * @return AdventureEventManager the games event manager
     */
    public function getAdventureEventManager(): AdventureEventManager
    {
        return $this->eventManager;
    }
}
