<?php

declare(strict_types=1);

namespace App\Entity;

use PHPUnit\Framework\TestCase;
use DateTime;

/**
 * Test cases for the Achievement class
 */

class AchievementLogTest extends TestCase
{
    /**
     * Test that an object of the class
     * can be created.
     */
    public function testCreateAchievementLogObject()
    {
        $achievementLog = new AchievementLog();

        $this->assertInstanceOf("\App\Entity\AchievementLog", $achievementLog);
    }

    /**
     * Test getId method
     */
    public function testGetId()
    {
        $achievementLog = new AchievementLog();

        $actualValue = $achievementLog->getId();

        $this->assertNull($actualValue);
    }

    /**
     * Test set/get date methods
     */
    public function testSetGetDate()
    {
        $object = new AchievementLog();

        $object->setDate(new DateTime());

        $actualValue = $object->getDate();

        $this->assertInstanceOf("\DateTime", $actualValue);
    }

    /**
     * Test set/get playerName methods
     */
    public function testSetGetPlayerName()
    {
        $object = new AchievementLog();

        $object->setPlayerName("none");

        $actualValue = $object->getPlayerName();

        $this->assertEquals($actualValue, "none");
    }

    /**
     * Test getAchievements method
     */
    public function testGetAchievements()
    {
        $object = new AchievementLog();

        $actualValue = $object->getAchievements();

        $this->assertNotNull($actualValue);
    }

    /**
     * Test addAchievements method
     */
    public function testAddAchievement()
    {
        $object = new AchievementLog();

        $achievement = new Achievement();

        $actualValue = $object->addAchievement($achievement);

        $this->assertInstanceOf("App\Entity\AchievementLog", $actualValue);
    }

    /**
     * Test removeAchievements method
     */
    /* public function testRemoveAchievement()
    {
        $object = new AchievementLog();

        $achievement = new Achievement();

        $object->addAchievement($achievement);

        $actualValue = $object->removeAchievement($achievement);

        $this->assertInstanceOf("App\Entity\AchievementLog", $actualValue);
    } */
}
