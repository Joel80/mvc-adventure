<?php

declare(strict_types=1);

namespace App\Adventure;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\AchievementLog;
use App\Entity\RoomVisitLog;
use App\Entity\Visit;
use App\Entity\ItemDescriptor;
use App\Entity\ExitDescriptor;
use App\Entity\EventDescriptor;
use App\Entity\RoomDescriptor;
use DateTime;

class DbDataHandler
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createAchievementLog(string $playerName = "NoName"): AchievementLog
    {
        //Create log and set date
        $adventureLog = new AchievementLog();

        $adventureLog->setDate(new DateTime());

        $adventureLog->setPlayerName($playerName);

        //Save log object in database
        /* $entityManager = $this->getDoctrine()->getManager(); */
        $this->entityManager->persist($adventureLog);
        $this->entityManager->flush();

        return $adventureLog;
    }

    public function getRoomDescriptors(): array
    {
        //Get the room descriptors from the database
        $roomDescriptors = $this->entityManager
        ->getRepository(RoomDescriptor::class)
        ->findAll();

        return $roomDescriptors;
    }

    public function getItemDescriptors(): array
    {
        //Get the room descriptors from the database
        $itemDescriptors = $this->entityManager
        ->getRepository(ItemDescriptor::class)
        ->findAll();

        return $itemDescriptors;
    }

    public function getEventDescriptors(): array
    {
        //Get the room descriptors from the database
        $eventDescriptors = $this->entityManager
        ->getRepository(EventDescriptor::class)
        ->findAll();

        return $eventDescriptors;
    }

    public function getExitDescriptors(): array
    {
        //Get the room descriptors from the database
        $exitDescriptors = $this->entityManager
        ->getRepository(ExitDescriptor::class)
        ->findAll();

        return $exitDescriptors;
    }

    public function createRoomVisitLog(array $roomDescriptors, string $playerName = "NoName"): RoomVisitLog
    {
        $roomVisitLog = new RoomVisitLog();

        $roomVisitLog->setDate(new DateTime());

        $roomVisitLog->setPlayerName($playerName);

        $this->entityManager->persist($roomVisitLog);
        $this->entityManager->flush();

        foreach ($roomDescriptors as $roomDescriptor) {
            $roomName = $roomDescriptor->getRoomName();
            $roomIndex = $roomDescriptor->getRoomIndex();
            $visit = new Visit();
            $visit->setRoomName($roomName);
            $visit->setRoomIndex($roomIndex);
            $visit->setTimesVisited(0);
            $visit->setRoomVisitLog($roomVisitLog);
            $this->entityManager->persist($visit);
        }

        $this->entityManager->flush();

        return $roomVisitLog;
    }
}
