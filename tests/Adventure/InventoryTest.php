<?php

declare(strict_types=1);

namespace App\Adventure;

use PHPUnit\Framework\TestCase;
use App\Adventure\Item;
use App\Adventure\Inventory;

/**
 * Test cases for the Inventory class
 */

class InventoryTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateInventoryObject()
    {
        $inventory = new Inventory();

        $this->assertInstanceOf("\App\Adventure\Inventory", $inventory);
    }

    /**
     * Test get add item methods
     */
    public function testGetAddItem()
    {
        $inventory = new Inventory();

        $item = new Item("none", "none", "none", "none");

        $inventory->addItem($item, "none");

        $actualValue = $inventory->getItem("none");

        $this->assertInstanceOf("\App\Adventure\Item", $actualValue);
    }

    /**
     * Test get item returns null if item not found
     */
    public function testGetItemReturnsNull()
    {
        $inventory = new Inventory();

        $item = new Item("none", "none", "none", "none");

        $inventory->addItem($item, "none");

        $actualValue = $inventory->getItem("one");

        $this->assertNull($actualValue);
    }

    /**
     * Test get items
     */
    public function testGetItems()
    {
        $inventory = new Inventory();

        $actualValue = $inventory->getItems();

        $this->assertIsArray($actualValue);
    }

     /**
     * Test remove item methods
     */
    public function testRemoveItem()
    {
        $inventory = new Inventory();

        $item = new Item("none", "none", "none", "none");

        $inventory->addItem($item, "none");

        $inventory->removeItem("none");

        $actualValue = $inventory->getItems();

        $this->assertEmpty($actualValue);
    }
}
