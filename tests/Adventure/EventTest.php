<?php

declare(strict_types=1);

namespace App\Adventure;

use PHPUnit\Framework\TestCase;
use App\Adventure\Room;
use App\Adventure\RoomExit;

/**
 * Test cases for the Event class
 */

class EventTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateEventObject()
    {
        $room = new Room("none", "none", "none", "none");

        $event = new Event("none", "none", "none", $room, "none");

        $this->assertInstanceOf("\App\Adventure\Event", $event);
    }

    /**
     * Test the getEventId method
     */
    public function testventGetEventId()
    {
        $room = new Room("none", "none", "none", "none");

        $event = new Event("none", "none", "none", $room, "none");

        $actualValue = $event->getEventId();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test the getDescription method
     */
    public function testventGetDescription()
    {
        $room = new Room("none", "none", "none", "none");

        $event = new Event("none", "none", "none", $room, "none");

        $actualValue = $event->getDescription();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test the getRoomDescription method
     */
    public function testventGetRoomDescription()
    {
        $room = new Room("none", "none", "none", "none");

        $event = new Event("none", "none", "none", $room, "none");

        $actualValue = $event->getRoomDescription();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test the getEventRoom method
     */
    public function testEventGetEventRoom()
    {
        $room = new Room("none", "none", "none", "none");

        $event = new Event("none", "none", "none", $room, "none");

        $actualValue = $event->getEventRoom();

        $this->assertInstanceOf("\App\Adventure\Room", $actualValue);
    }

    /**
     * Test the getExit method
     */
    public function testEventGetExit()
    {
        $room = new Room("none", "none", "none", "none");

        $event = new Event("none", "none", "none", $room, "none");

        $exit = new RoomExit($room, "none");

        $event->setExit($exit);

        $actualValue = $event->getExit();

        $this->assertInstanceOf("\App\Adventure\RoomExit", $actualValue);
    }

    /**
     * Test the setExit method
     */
    public function testEventSetExit()
    {
        $room = new Room("none", "none", "none", "none");

        $event = new Event("none", "none", "none", $room, "none");

        $exit = new RoomExit($room, "none");

        $event->setExit($exit);

        $actualValue = $event->getExit();

        $this->assertInstanceOf("\App\Adventure\RoomExit", $actualValue);
    }

    /**
     * Test the get/setExitIsIn methods
     */
    public function testEventGetSetExitIsIn()
    {
        $room = new Room("none", "none", "none", "none");

        $event = new Event("none", "none", "none", $room, "none");

        $event->setExitIsIn($room);

        $actualValue = $event->getExitIsIn();

        $this->assertInstanceOf("\App\Adventure\Room", $actualValue);
    }

    /**
     * Test the getPassed (setPassed) methods
     */
    public function testEventGetSetPassed()
    {
        $room = new Room("none", "none", "none", "none");

        $event = new Event("none", "none", "none", $room, "none");

        $event->setPassed(true);

        $actualValue = $event->getPassed();

        $this->assertTrue($actualValue);
    }

    /**
     * Test the getAchievement method
     */
    public function testEventGeAchievement()
    {
        $room = new Room("none", "none", "none", "none");

        $event = new Event("none", "none", "none", $room, "none");

        $actualValue = $event->getAchievement();

        $this->assertEquals($actualValue, "none");
    }
}