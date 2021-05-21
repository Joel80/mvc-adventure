<?php

declare(strict_types=1);

namespace App\Adventure;

use PHPUnit\Framework\TestCase;
use App\Adventure\Player;
use App\Adventure\Room;
use App\Adventure\RoomExit;
use App\Adventure\AdventureData;
use App\Adventure\AdventureManager;
use App\Adventure\Map;
use App\Adventure\Event;
use App\Entity\Achievement;
use App\Entity\AchievementLog;
use App\Adventure\Inventory;
use App\Adventure\Item;
use App\Adventure\AdventureDataSetter;
use App\Entity\RoomVisitLog;
use App\Entity\Visit;
use App\Entity\ItemDescriptor;
use App\Entity\EventDescriptor;
use App\Entity\RoomDescriptor;
use App\Entity\ExitDescriptor;

/**
 * Test cases for the AdventureData class
 */

class AdventureSetupTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateAdventureSetupObject()
    {
        $adventureSetup = new AdventureSetup();

        $this->assertInstanceOf("\App\Adventure\AdventureSetup", $adventureSetup);
    }

     /**
     * Test the setup method
     */
    public function testAdventureSetupSetupMethod()
    {
        $adventureSetup = new AdventureSetup();

        $roomDescriptor = new RoomDescriptor();

        $roomDescriptor->setDescription("none");

        $roomDescriptor->setRoomIndex("roomOne");

        $roomDescriptor->setRoomImage("none");

        $roomDescriptor->setRoomName("none");

        $roomDescriptors = [$roomDescriptor];


        $itemDescriptor = new ItemDescriptor();

        $itemDescriptor->setDescription("none");

        $itemDescriptor->setName("none");

        $itemDescriptor->setItemId("none");

        $itemDescriptor->setPlacementDescription("none");

        $itemDescriptor->setRoomIndex("roomOne");

        $itemDescriptors = [$itemDescriptor];


        $exitDescriptor = new ExitDescriptor();

        $exitDescriptor->setLeadsToRoom("roomOne");

        $exitDescriptor->setLocatedInRoom("roomOne");

        $exitDescriptor->setName("none");

        $exitDescriptors = [$exitDescriptor];


        $eventDescriptor = new EventDescriptor();

        $eventDescriptor->setEvent("none");

        $eventDescriptor->setDescription("none");

        $eventDescriptor->setRoomDescription("none");

        $eventDescriptor->setEventRoom("roomOne");

        $eventDescriptor->setAchievement("none");

        $eventDescriptor->setAddExit(true);

        $eventDescriptor->setExitLeadsTo("roomOne");

        $eventDescriptor->setExitIsInRoom("roomOne");

        $eventDescriptor->setExitName("none");

        $eventDescriptors = [$eventDescriptor];

        $actualValue = $adventureSetup->setup(new AchievementLog(), $roomDescriptors, $itemDescriptors, $exitDescriptors, $eventDescriptors, new RoomVisitLog());

        $this->assertInstanceOf("\App\Adventure\AdventureManager", $actualValue);
    }
}