<?php

declare(strict_types=1);

namespace App\Adventure;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Player class
 */

class PlayerTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreatePlayerObject()
    {
        $room = new Room("none", "none", "none", "none");
        $player = new Player($room);

        $this->assertInstanceOf("\App\Adventure\Player", $player);
    }

    /**
     * Test getCurrentRoom method
     */
    public function testGetCurrentRoom()
    {
        $room = new Room("none", "none", "none", "none");
        $player = new Player($room);

        $actualValue = $player->getCurrentRoom();

        $this->assertInstanceOf("\App\Adventure\Room", $actualValue);
    }

    /**
     * Test setCurrentRoom method
     */
    public function testSetCurrentRoom()
    {
        $room = new Room("none", "none", "none", "none");

        $room2 = new Room("none", "one", "none", "none");

        $player = new Player($room);

        $player->setCurrentRoom($room2);

        $room3 = $player->getCurrentRoom();

        $actualValue = $room3->getRoomIndex();

        $this->assertEquals($actualValue, "one");
    }

    /**
     * Test set and get Inventory methods
     */
    public function testSetGetInventory()
    {
        $room = new Room("none", "none", "none", "none");

        $player = new Player($room);

        $player->setInventory(new Inventory());

        $actualValue = $player->getInventory();

        $this->assertInstanceOf("\App\Adventure\Inventory", $actualValue);
    }
}
