<?php

declare(strict_types=1);

namespace App\Adventure;

use App\Adventure\Player;
use App\Adventure\AdventureData;
use App\Adventure\AdventureManager;
use App\Adventure\Map;
use App\Entity\Achievement;
use App\Entity\AchievementLog;
use App\Adventure\Inventory;
use App\Adventure\Item;
use App\Entity\RoomDescriptor;
use App\Adventure\AdventureDataSetter;
use App\Entity\RoomVisitLog;
use App\Entity\Visit;

class AdventureManagerCreator
{
    public function __construct()
    {
    }

    public function createAdventureManager(array $setupObjects, RoomVisitLog $roomVisitLog, AchievementLog $adventureLog)
    {
        //Get map
        $map = $setupObjects[0];

        //Get events
        $events = $setupObjects[1];

        //Create achievementholder for AdventureEventManager
        $achievementHolder = new Achievement();

        //Create player
        $player = new Player($map->getRoom("roomOne"));

        $playerInventory = new Inventory();

        $player->setInventory($playerInventory);

        //Create adventureData
        $adventureData = new AdventureData();

        $adventureDataSetter = new AdventureDataSetter($adventureData, $player);

        //Create adventuerEventManager
        $eventManager = new AdventureEventManager($events, $achievementHolder);

        //Create and return adventureManager
        $adventureManager = new AdventureManager($player, $adventureDataSetter, $map, $adventureLog, $eventManager, $roomVisitLog);

        return $adventureManager;
    }
}
