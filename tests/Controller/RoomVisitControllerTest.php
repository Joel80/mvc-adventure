<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\RoomVisitLog;

class RoomVisitControllerTest extends WebTestCase
{
    public function testRoomVisitIndexRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/room/visit');

        $this->assertResponseIsSuccessful();
    }

    public function testRoomVisitControllerFindAllRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/room/visit/all');

        $this->assertResponseIsSuccessful();
    }

    public function testRoomVisitControllerShowVisitsRoute()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', "/room/visit/all");
        $link = $crawler->selectLink('Show visits')->link();
        $client->click($link);

        $this->assertResponseIsSuccessful();
    }
}
