<?php

declare(strict_types=1);

namespace App\Adventure;

use PHPUnit\Framework\TestCase;
use App\Adventure\Player;
use App\Adventure\Room;
use App\Adventure\RoomExit;
use App\Entity\Achievement;
use App\Entity\AchievementLog;
use App\Entity\RoomVisitLog;
use App\Adventure\AdventureEventManager;
use App\Adventure\AdventureDataSetter;
use App\Adventure\Map;

/**
 * Test cases for the AdventureData class
 */

class AdventureManagerTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testAdventureManagerObject()
    {
        $room = new Room("none", "none", "none", "none");

        $player = new Player($room);

        $adventureData = new AdventureData();

        $event = new Event("none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $achievement = new Achievement();

        $map = new Map();

        $achievementLog = new AchievementLog;

        $roomVisitLog = new RoomVisitLog;

        $adventureDataSetter = new AdventureDataSetter($adventureData, $player);

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $adventureManager = new AdventureManager($player, $adventureDataSetter, $map, $achievementLog, $adventureEventManager, $roomVisitLog);

        $this->assertInstanceOf("\App\Adventure\AdventureManager", $adventureManager);
    }

    /**
     * Test getAdventureDataSetter method
     */
    public function testAdventureManagerGetAdventureDataSetter()
    {
        $room = new Room("none", "none", "none", "none");

        $player = new Player($room);

        $adventureData = new AdventureData();

        $event = new Event("none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $achievement = new Achievement();

        $map = new Map();

        $achievementLog = new AchievementLog;

        $roomVisitLog = new RoomVisitLog;

        $adventureDataSetter = new AdventureDataSetter($adventureData, $player);

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $adventureManager = new AdventureManager($player, $adventureDataSetter, $map, $achievementLog, $adventureEventManager, $roomVisitLog);

        $actualValue = $adventureManager->getAdventureDataSetter();

        $this->assertInstanceOf("\App\Adventure\AdventureDataSetter", $actualValue);
    }

    /**
     * Test getPlayer method
     */
    public function testAdventureManagerGetPlayer()
    {
        $room = new Room("none", "none", "none", "none");

        $player = new Player($room);

        $adventureData = new AdventureData();

        $event = new Event("none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $achievement = new Achievement();

        $map = new Map();

        $achievementLog = new AchievementLog;

        $roomVisitLog = new RoomVisitLog;

        $adventureDataSetter = new AdventureDataSetter($adventureData, $player);

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $adventureManager = new AdventureManager($player, $adventureDataSetter, $map, $achievementLog, $adventureEventManager, $roomVisitLog);

        $actualValue = $adventureManager->getPlayer();

        $this->assertInstanceOf("\App\Adventure\Player", $actualValue);
    }

    /**
     * Test getAchievementLog method
     */
    public function testAdventureManagerGetAchievementLog()
    {
        $room = new Room("none", "none", "none", "none");

        $player = new Player($room);

        $adventureData = new AdventureData();

        $event = new Event("none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $achievement = new Achievement();

        $map = new Map();

        $achievementLog = new AchievementLog;

        $roomVisitLog = new RoomVisitLog;

        $adventureDataSetter = new AdventureDataSetter($adventureData, $player);

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $adventureManager = new AdventureManager($player, $adventureDataSetter, $map, $achievementLog, $adventureEventManager, $roomVisitLog);

        $actualValue = $adventureManager->getAchievementLog();

        $this->assertInstanceOf("\App\Entity\AchievementLog", $actualValue);
    }

    /**
     * Test getRoomVisitLog method
     */
    public function testAdventureManagerGetRoomVisitLog()
    {
        $room = new Room("none", "none", "none", "none");

        $player = new Player($room);

        $adventureData = new AdventureData();

        $event = new Event("none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $achievement = new Achievement();

        $map = new Map();

        $achievementLog = new AchievementLog;

        $roomVisitLog = new RoomVisitLog;

        $adventureDataSetter = new AdventureDataSetter($adventureData, $player);

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $adventureManager = new AdventureManager($player, $adventureDataSetter, $map, $achievementLog, $adventureEventManager, $roomVisitLog);

        $actualValue = $adventureManager->getRoomVisitLog();

        $this->assertInstanceOf("\App\Entity\RoomVisitLog", $actualValue);
    }

    /**
     * Test getAdventureEventManager method
     */
    public function testAdventureManagerGetAdventureEventManager()
    {
        $room = new Room("none", "none", "none", "none");

        $player = new Player($room);

        $adventureData = new AdventureData();

        $event = new Event("none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $achievement = new Achievement();

        $map = new Map();

        $achievementLog = new AchievementLog;

        $roomVisitLog = new RoomVisitLog;

        $adventureDataSetter = new AdventureDataSetter($adventureData, $player);

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $adventureManager = new AdventureManager($player, $adventureDataSetter, $map, $achievementLog, $adventureEventManager, $roomVisitLog);

        $actualValue = $adventureManager->getAdventureEventManager();

        $this->assertInstanceOf("\App\Adventure\AdventureEventManager", $actualValue);
    }

    /**
     * Test getAdventureEventManager method
     */
    public function testAdventureManagerGetMap()
    {
        $room = new Room("none", "none", "none", "none");

        $player = new Player($room);

        $adventureData = new AdventureData();

        $event = new Event("none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $achievement = new Achievement();

        $map = new Map();

        $achievementLog = new AchievementLog;

        $roomVisitLog = new RoomVisitLog;

        $adventureDataSetter = new AdventureDataSetter($adventureData, $player);

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $adventureManager = new AdventureManager($player, $adventureDataSetter, $map, $achievementLog, $adventureEventManager, $roomVisitLog);

        $actualValue = $adventureManager->getMap();

        $this->assertInstanceOf("\App\Adventure\Map", $actualValue);
    }

}