<?php

declare(strict_types=1);

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Achievement class
 */

class AchievementTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateAchievementObject()
    {
        $achievement = new Achievement();

        $this->assertInstanceOf("\App\Entity\Achievement", $achievement);
    }

    /**
     * Test getId method
     */
    public function testGetId()
    {
        $achievement = new Achievement();

        $actualValue = $achievement->getId();

        $this->assertNull($actualValue);
    }

    /**
     * Test set/get description methods
     */
    public function testSetGetDescription()
    {
        $achievement = new Achievement();

        $achievement->setDescription("none");

        $actualValue = $achievement->getDescription();

        $this->assertEquals($actualValue, "none");
    }
}
