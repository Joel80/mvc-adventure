<?php

declare(strict_types=1);

namespace App\Adventure;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Map class
 */

class MapTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateMapObject()
    {
        $map = new Map();

        $this->assertInstanceOf("\App\Adventure\Map", $map);
    }

    /**
     * Test getMap method
     */
    public function testGetMap()
    {
        $map = new Map();

        $actualValue = $map->getMap();

        $this->assertIsArray($actualValue);
    }

    /**
     * Test addRoom getRoom methods
     */
    public function testAddGetRoom()
    {
        $map = new Map();

        $room = new Room("none", "none", "none", "none");

        $map->addRoom($room, "none");

        $actualValue = $map->getRoom("none");

        $this->assertInstanceOf("\App\Adventure\Room", $actualValue);
    }
}
