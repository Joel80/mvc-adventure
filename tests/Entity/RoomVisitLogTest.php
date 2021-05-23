<?php

declare(strict_types=1);

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use DateTime;

/**
 * Test cases for the RoomVisitLog class
 */

class RoomVisitLogTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateRoomvisitLogObject()
    {
        $roomvisitLog = new RoomvisitLog();

        $this->assertInstanceOf("\App\Entity\RoomvisitLog", $roomvisitLog);
    }

    /**
     * Test getId method
     */
    public function testGetId()
    {
        $roomvisitLog = new RoomvisitLog();

        $actualValue = $roomvisitLog->getId();

        $this->assertNull($actualValue);
    }

    /**
     * Test set/get date methods
     */
    public function testSetGetDate()
    {
        $object = new RoomvisitLog();

        $object->setDate(new DateTime());

        $actualValue = $object->getDate();

        $this->assertInstanceOf("\DateTime", $actualValue);
    }

    /**
     * Test set/get playerName methods
     */
    public function testSetGetPlayerName()
    {
        $object = new RoomvisitLog();

        $object->setPlayerName("none");

        $actualValue = $object->getPlayerName();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test getRoomvisits method
     */
    public function testGetVisits()
    {
        $object = new RoomvisitLog();

        $actualValue = $object->getVisits();

        $this->assertNotNull($actualValue);
    }

    /**
     * Test addRoomvisits method
     */
    public function testAddVisit()
    {
        $object = new RoomvisitLog();

        $roomvisit = new Visit();

        $actualValue = $object->addVisit($roomvisit);

        $this->assertInstanceOf("App\Entity\RoomvisitLog", $actualValue);
    }

    /**
     * Test removeRoomvisits method
     */
    /* public function testRemoveRoomvisit()
    {
        $object = new RoomvisitLog();

        $Roomvisit = new Roomvisit();

        $object->addRoomvisit($Roomvisit);

        $actualValue = $object->removeRoomvisit($Roomvisit);

        $this->assertInstanceOf("App\Entity\RoomvisitLog", $actualValue);
    } */
}
