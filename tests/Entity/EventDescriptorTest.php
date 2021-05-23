<?php

declare(strict_types=1);

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Achievement class
 */

class EventDescriptorTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateEventDescriptorObject()
    {
        $object = new EventDescriptor();

        $this->assertInstanceOf("\App\Entity\EventDescriptor", $object);
    }

    /**
     * Test getId method
     */
    public function testGetId()
    {
        $object = new EventDescriptor();

        $actualValue = $object->getId();

        $this->assertNull($actualValue);
    }

    /**
     * Test get/set description methods
     */
    public function testGetSetDescription()
    {
        $object = new EventDescriptor();

        $object->setDescription("none");

        $actualValue = $object->getDescription();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test get/set roomDescription methods
     */
    public function testGetSetRoomDescription()
    {
        $object = new EventDescriptor();

        $object->setRoomDescription("none");

        $actualValue = $object->getRoomDescription();

        $this->assertEquals($actualValue, "none");
    }

     /**
     * Test get/set eventRoom methods
     */
    public function testGetSetEventRoom()
    {
        $object = new EventDescriptor();

        $object->setEventRoom("none");

        $actualValue = $object->getEventRoom();

        $this->assertEquals($actualValue, "none");
    }

      /**
     * Test get/set achievement methods
     */
    public function testGetSetAchievement()
    {
        $object = new EventDescriptor();

        $object->setAchievement("none");

        $actualValue = $object->getAchievement();

        $this->assertEquals($actualValue, "none");
    }
}
