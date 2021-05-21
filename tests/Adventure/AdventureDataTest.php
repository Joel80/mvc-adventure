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

/**
 * Test cases for the AdventureData class
 */

class AdventureDataTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateAdventureDataObject()
    {
        $adventureData = new AdventureData();

        $this->assertInstanceOf("\App\Adventure\AdventureData", $adventureData);
    }

    /**
     * Test setting of data with AdventureDataSetter
     */
    public function testSettingOfAdentureData()
    {
        $room = new Room("none", "none", "none", "none");

        $room2 = new Room("none", "none", "none", "none");

        $exit = new RoomExit($room2, "none");

        $item = new Item("none", "none", "none", "none");

        $room->setInventory(new Inventory());

        $room->getInventory()->addItem($item, $item->getItemId());

        $room->addExit($exit);

        $player = new Player($room);

        $player->setInventory(new Inventory());

        $player->getInventory()->addItem($item, $item->getItemId());

        $adventureData = new AdventureData();

        $adventureDataSetter = new AdventureDataSetter($adventureData, $player);

        $adventureDataSetter->setData();

        $data = $adventureDataSetter->getAdventureData();

        $this->assertIsArray($data);
    }
}
