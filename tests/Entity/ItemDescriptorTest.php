<?php

declare(strict_types=1);

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Achievement class
 */

class ItemDescriptorTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateexitDescriptorObject()
    {
        $object = new ItemDescriptor();

        $this->assertInstanceOf("\App\Entity\ItemDescriptor", $object);
    }

    /**
     * Test getId method
     */
    public function testGetId()
    {
        $object = new ItemDescriptor();

        $actualValue = $object->getId();

        $this->assertNull($actualValue);
    }

    /**
     * Test get/set leadsToRoom methods
     */
    public function testGetSetDescription()
    {
        $object = new ItemDescriptor();

        $object->setDescription("none");

        $actualValue = $object->getDescription();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test get/set name methods
     */
    public function testGetSetName()
    {
        $object = new ItemDescriptor();

        $object->setName("none");

        $actualValue = $object->getName();

        $this->assertEquals($actualValue, "none");
    }

     /**
     * Test get/set itemId methods
     */
    public function testGetSetItemId()
    {
        $object = new ItemDescriptor();

        $object->setItemId("none");

        $actualValue = $object->getItemId();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test get/set placementDescription methods
     */
    public function testGetPlacementDescription()
    {
        $object = new ItemDescriptor();

        $object->setPlacementDescription("none");

        $actualValue = $object->getPlacementDescription();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test get/set roomIndex methods
     */
    public function testGetSetRoomIndex()
    {
        $object = new ItemDescriptor();

        $object->setRoomIndex("none");

        $actualValue = $object->getRoomIndex();

        $this->assertEquals($actualValue, "none");
    }
}
