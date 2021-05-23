<?php

declare(strict_types=1);

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Visit class
 */

class VisitTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateVisitObject()
    {
        $roomVisit = new Visit();

        $this->assertInstanceOf("\App\Entity\Visit", $roomVisit);
    }

    /**
     * Test getId method
     */
    public function testGetId()
    {
        $visit = new Visit();

        $actualValue = $visit->getId();

        $this->assertNull($actualValue);
    }

    /**
     * Test set/get roomName methods
     */
    public function testSetGetRoomName()
    {
        $object = new Visit();

        $object->setRoomName("none");

        $actualValue = $object->getRoomName();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test set/get visited methods
     */
    public function testSetGetTimesVisitet()
    {
        $object = new Visit();

        $object->setTimesVisited(1);

        $actualValue = $object->getTimesVisited();

        $this->assertEquals($actualValue, 1);
    }

    /**
     * Test set/get roomIndex methods
     */
    public function testSetGetRoomIndex()
    {
        $object = new Visit();

        $object->setRoomIndex("none");

        $actualValue = $object->getRoomIndex();

        $this->assertEquals($actualValue, "none");
    }
}
