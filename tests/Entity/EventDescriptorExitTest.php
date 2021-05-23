<?php

declare(strict_types=1);

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Achievement class
 */

class EventDescriptorExitTest extends TestCase
{
    /**
     * Test get/set addExit methods
     */
    public function testGetSetAddExit()
    {
        $object = new EventDescriptor();

        $object->setAddExit(true);

        $actualValue = $object->getAddExit();

        $this->assertTrue($actualValue);
    }

    /**
     * Test get/set exitLeadsTo methods
     */
    public function testGetSetExitLeadsTo()
    {
        $object = new EventDescriptor();

        $object->setExitLeadsTo("none");

        $actualValue = $object->getExitLeadsTo();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test get/set exitIsInRoom methods
     */
    public function testGetSetExitIsInRoom()
    {
        $object = new EventDescriptor();

        $object->setExitIsInRoom("none");

        $actualValue = $object->getExitIsInRoom();

        $this->assertEquals($actualValue, "none");
    }

     /**
     * Test get/set exitName methods
     */
    public function testGetSetExitName()
    {
        $object = new EventDescriptor();

        $object->setExitName("none");

        $actualValue = $object->getExitName();

        $this->assertEquals($actualValue, "none");
    }
}
