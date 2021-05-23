<?php

declare(strict_types=1);

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Achievement class
 */

class RoomDescriptorTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateexitDescriptorObject()
    {
        $object = new RoomDescriptor();

        $this->assertInstanceOf("\App\Entity\RoomDescriptor", $object);
    }

    /**
     * Test getId method
     */
    public function testGetId()
    {
        $object = new RoomDescriptor();

        $actualValue = $object->getId();

        $this->assertNull($actualValue);
    }

    /**
     * Test get/set description methods
     */
    public function testGetSetDescription()
    {
        $object = new RoomDescriptor();

        $object->setDescription("none");

        $actualValue = $object->getDescription();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test get/set roomIndex methods
     */
    public function testGetSetRoomIndex()
    {
        $object = new RoomDescriptor();

        $object->setRoomIndex("none");

        $actualValue = $object->getRoomIndex();

        $this->assertEquals($actualValue, "none");
    }

     /**
     * Test get/set roomImage methods
     */
    public function testGetSetRoomImage()
    {
        $object = new RoomDescriptor();

        $object->setRoomImage("none");

        $actualValue = $object->getRoomImage();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test get/set roomName methods
     */
    public function testGetSetRoomNamel()
    {
        $object = new RoomDescriptor();

        $object->setRoomName("none");

        $actualValue = $object->getRoomName();

        $this->assertEquals($actualValue, "none");
    }
}
