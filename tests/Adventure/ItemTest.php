<?php

declare(strict_types=1);

namespace App\Adventure;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Inventory class
 */

class ItemTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateItemObject()
    {
        $item = new Item("none", "none", "none", "none");

        $this->assertInstanceOf("\App\Adventure\Item", $item);
    }

    /**
     * Test getDescription method
     */
    public function testGetDescription()
    {
        $item = new Item("none", "none", "none", "none");

        $actualValue = $item->getDescription();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test getPlacementDescription method
     */
    public function testGetPlacementDescription()
    {
        $item = new Item("none", "none", "none", "none");

        $actualValue = $item->getPlacementDescription();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test getName method
     */
    public function testGetName()
    {
        $item = new Item("none", "none", "none", "none");

        $actualValue = $item->getName();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test getName method
     */
    public function testGetItemID()
    {
        $item = new Item("none", "none", "none", "none");

        $actualValue = $item->getItemId();

        $this->assertEquals($actualValue, "none");
    }
}
