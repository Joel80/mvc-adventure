<?php

declare(strict_types=1);

namespace App\Adventure;

use PHPUnit\Framework\TestCase;
use App\Adventure\AdventureData;
use App\Adventure\Room;
use App\Adventure\Player;
use App\Adventure\Inventory;
use App\Adventure\RoomExit;
use App\Adventure\Item;
use App\Entity\Achievement;
use App\Adventure\AdventureEventManager;

/**
 * Test cases for the AdventureData class
 */

class AdventureEventManagerTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateAdventureEventManagerObject()
    {
        $room = new Room("none", "none", "none", "none");

        $achievement = new Achievement();

        $event = new Event("none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $this->assertInstanceOf("\App\Adventure\AdventureEventManager", $adventureEventManager);
    }

    /**
     * Test setLastAchievement method 
     */
    public function testAdventureEventManagerSetLastAchievement()
    {
        $room = new Room("none", "none", "none", "none");

        $achievement = new Achievement();

        $achievement2 = new Achievement();

        $event = new Event("none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $adventureEventManager->setLastAchievement($achievement2);

        $achievement3 = $adventureEventManager->getLastAchievement();

        $this->assertInstanceOf("\App\Entity\Achievement", $achievement3);
    }

    /**
     * Test getLastAchievement method returns null
     * when lastAchievement is not set 
     */
    public function testAdventureEventManagerGetLastAchievementReturnsNull()
    {
        $room = new Room("none", "none", "none", "none");

        $achievement = new Achievement();

        $event = new Event("none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $achievement3 = $adventureEventManager->getLastAchievement();

        $this->assertNull($achievement3);
    }

    /**
     * Test checkEvent method not event
     */
    public function testAdventureEventManagerCheckEventNoEvent()
    {
        $room = new Room("none", "none", "none", "none");

        $achievement = new Achievement();

        $event = new Event("none&none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $room = new Room("none", "none", "none", "none");

        $player = new Player($room);

        $adventureEventManager->checkEvent("x", "y", $player);

        $descriptions = $player->getCurrentRoom()->getTempDescriptions();

        $actualValue = $descriptions[0];

        $expValue = "Nothing happens";

        $this->assertEquals($actualValue, $expValue);
    }

    /**
     * Test checkEvent method event
     */
    public function testAdventureEventManagerCheckEventIsEvent()
    {
        $room = new Room("none", "none", "none", "none");

        $achievement = new Achievement();

        $event = new Event("none&none", "none",  "none", $room, "none");
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $room = new Room("none", "none", "none", "none");

        $player = new Player($room);

        $adventureEventManager->checkEvent("none", "none", $player);

        $descriptions = $player->getCurrentRoom()->getTempDescriptions();

        $actualValue = $descriptions[0];

        $expValue = "none";

        $this->assertEquals($actualValue, $expValue);
    }

     /**
     * Test checkEvent method add exit
     */
    public function testAdventureEventManagerCheckEventAddsExit()
    {
        $room = new Room("none", "none", "none", "none");

        $achievement = new Achievement();

        $event = new Event("none&none", "none",  "none", $room, "none");

        $exit = new RoomExit($room, "none");

        $event->setExit($exit);

        $event->setExitIsIn($room);
        
        $events = [];

        $events[$event->getEventId()] = $event;

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $player = new Player($room);

        $adventureEventManager->checkEvent("none", "none", $player);

        $exits = $room->getExits();

        $actualValue = $exits[0];

        $this->assertInstanceOf("App\Adventure\RoomExit", $actualValue);
    }

    /**
     * Test checkEvent method passed event
     */
    public function testAdventureEventManagerCheckEventPassedEvent()
    {
        $room = new Room("none", "none", "none", "none");

        $achievement = new Achievement();

        $event = new Event("none&none", "none",  "none", $room, "none");

        $event->setPassed(true);

        $events = [];

        $events[$event->getEventId()] = $event;

        $adventureEventManager = new AdventureEventManager($events, $achievement);

        $player = new Player($room);

        $adventureEventManager->checkEvent("none", "none", $player);

        $descriptions = $player->getCurrentRoom()->getTempDescriptions();

        $actualValue = $descriptions[0];

        $expValue = "Nothing happens";

        $this->assertEquals($actualValue, $expValue);
    }
}
