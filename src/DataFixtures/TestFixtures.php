<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\RoomDescriptor;
use App\Entity\ItemDescriptor;
use App\Entity\EventDescriptor;
use App\Entity\ExitDescriptor;
use App\Entity\AchievementLog;
use App\Entity\Achievement;
use App\Adventure\AdventureDataSetter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use DateTime;

class TestFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $roomDescriptor = new RoomDescriptor();
        $roomDescriptor->setDescription('none');
        $roomDescriptor->setRoomIndex("roomOne");
        $roomDescriptor->setRoomImage("none");
        $roomDescriptor->setRoomName("none");
        $manager->persist($roomDescriptor);

        $eventDescriptor = new EventDescriptor();
        $eventDescriptor->setEvent("none&roomOne");
        $eventDescriptor->setDescription("none");
        $eventDescriptor->setRoomDescription("none");
        $eventDescriptor->setAddExit(false);
        $eventDescriptor->setExitLeadsTo(null);
        $eventDescriptor->setExitIsInRoom(null);
        $eventDescriptor->setExitName(null);
        $eventDescriptor->setEventRoom("roomOne");
        $eventDescriptor->setAchievement("none");
        $manager->persist($eventDescriptor);

        $exitDescriptor = new ExitDescriptor();
        $exitDescriptor->setLeadsToRoom("roomOne");
        $exitDescriptor->setLocatedInRoom("roomOne");
        $exitDescriptor->setName("none");
        $manager->persist($exitDescriptor);

        $itemDescriptor = new ItemDescriptor();
        $itemDescriptor->setDescription("none");
        $itemDescriptor->setName("none");
        $itemDescriptor->setItemId("none");
        $itemDescriptor->setPlacementDescription("none");
        $itemDescriptor->setRoomIndex("roomOne");
        $manager->persist($itemDescriptor);

        $achievementLog = new AchievementLog();

        $achievementLog->setDate(new DateTime());

        $achievementLog->setPlayerName("none");
        $manager->persist($achievementLog);
/*
        $logId = $achievementLog->getId();

        $log = $manager->getReference('App\Entity\AchievementLog', $logId); */

        $achievement = new Achievement();

        $achievement->setDescription("none");

        $achievement->setAchievementLog($achievementLog);

        $manager->persist($achievement);

        $manager->flush();
    }
}
