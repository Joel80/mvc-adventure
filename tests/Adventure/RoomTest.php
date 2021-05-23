<?php

declare(strict_types=1);

namespace App\Adventure;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Room class
 */

class RoomTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateRoomObject()
    {
        $room = new Room("none", "none", "none", "none");

        $this->assertInstanceOf("\App\Adventure\Room", $room);
    }

    /**
     * Test setDescription method
     */
    public function testSetDescription()
    {
        $room = new Room("none", "none", "none", "none");

        $room->setDescription("one");

        $actualValue = $room->getDescription();

        $this->assertEquals($actualValue, "one");
    }

    /**
     * Test add and get TempDescription methods
     */
    public function testAddGetTempDescription()
    {
        $room = new Room("none", "none", "none", "none");

        $room->addTempDescription("one");

        $actualValue = $room->getTempDescriptions();

        $this->assertNotEmpty($actualValue);
    }

    /**
     * Test remove TempDescription method
     */
    public function testRemoveTempDescription()
    {
        $room = new Room("none", "none", "none", "none");

        $room->addTempDescription("one");

        $room->removeTempDescriptions();

        $actualValue = $room->getTempDescriptions();

        $this->assertEmpty($actualValue);
    }

    /**
     * Test set and get Inventory methods
     */
    public function testSetGetInventory()
    {
        $room = new Room("none", "none", "none", "none");

        $room->setInventory(new Inventory());

        $actualValue = $room->getInventory();

        $this->assertInstanceOf("\App\Adventure\Inventory", $actualValue);
    }

    /**
     * Test add and get exits methods
     */
    public function testAddGetExits()
    {
        $room = new Room("none", "none", "none", "none");

        $exit = new RoomExit($room, "one");

        $room->addExit($exit);

        $actualValue = $room->getExits();

        $this->assertNotEmpty($actualValue);
    }

    /**
     * Test set and get RoomIndex methods
     */
    public function testSetGetRoomIndex()
    {
        $room = new Room("none", "none", "none", "none");

        $room->setRoomIndex("one");

        $actualValue = $room->getRoomIndex();

        $this->assertEquals($actualValue, "one");
    }

    /**
     * Test set and get RoomImageUrl methods
     */
    public function testSetGetRoomImageUrl()
    {
        $room = new Room("none", "none", "none", "none");

        $room->setRoomImageUrl("one");

        $actualValue = $room->getRoomImageUrl();

        $this->assertEquals($actualValue, "one");
    }

    /**
     * Test set and get RoomName methods
     */
    public function testSetGetRoomName()
    {
        $room = new Room("none", "none", "none", "none");

        $room->setRoomName("one");

        $actualValue = $room->getRoomName();

        $this->assertEquals($actualValue, "one");
    }
}
