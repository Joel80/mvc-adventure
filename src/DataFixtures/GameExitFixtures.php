<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\RoomDescriptor;
use App\Entity\ItemDescriptor;
use App\Entity\EventDescriptor;
use App\Entity\ExitDescriptor;
use App\Adventure\AdventureDataSetter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class GameExitFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['game'];
    }

    public function load(ObjectManager $manager)
    {
        /* $exitDescriptor = new ExitDescriptor();
        $exitDescriptor->setLeadsToRoom("roomOne");
        $exitDescriptor->setLocatedInRoom("roomTwo");
        $exitDescriptor->setName("Southern Exit");
        $manager->persist($exitDescriptor);

        $exitDescriptor = new ExitDescriptor();
        $exitDescriptor->setLeadsToRoom("roomThree");
        $exitDescriptor->setLocatedInRoom("roomTwo");
        $exitDescriptor->setName("Eastern Exit");
        $manager->persist($exitDescriptor);

        $exitDescriptor = new ExitDescriptor();
        $exitDescriptor->setLeadsToRoom("roomTwo");
        $exitDescriptor->setLocatedInRoom("roomThree");
        $exitDescriptor->setName("Western Exit");
        $manager->persist($exitDescriptor);

        $exitDescriptor = new ExitDescriptor();
        $exitDescriptor->setLeadsToRoom("roomFour");
        $exitDescriptor->setLocatedInRoom("roomThree");
        $exitDescriptor->setName("Eastern Exit");
        $manager->persist($exitDescriptor);

        $exitDescriptor = new ExitDescriptor();
        $exitDescriptor->setLeadsToRoom("roomFive");
        $exitDescriptor->setLocatedInRoom("roomThree");
        $exitDescriptor->setName("Northern Exit");
        $manager->persist($exitDescriptor);

        $exitDescriptor = new ExitDescriptor();
        $exitDescriptor->setLeadsToRoom("roomThree");
        $exitDescriptor->setLocatedInRoom("roomFour");
        $exitDescriptor->setName("Western Exit");
        $manager->persist($exitDescriptor);

        $exitDescriptor = new ExitDescriptor();
        $exitDescriptor->setLeadsToRoom("roomThree");
        $exitDescriptor->setLocatedInRoom("roomFive");
        $exitDescriptor->setName("Southern Exit");
        $manager->persist($exitDescriptor);

        $manager->flush(); */
    }
}
