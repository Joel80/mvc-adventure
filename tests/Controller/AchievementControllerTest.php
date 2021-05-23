<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\AchievementLog;

class AchievementControllerTest extends WebTestCase
{
    public function testAchievementControllerIndexRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/log');

        $this->assertResponseIsSuccessful();
    }

    public function testAchievementControllerFindAllLogRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/log/all');

        $this->assertResponseIsSuccessful();
    }

    public function testAchievementControllerShowEventsRoute()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', "/log/all");
        $link = $crawler->selectLink('Show achievements')->link();
        $client->click($link);

        $this->assertResponseIsSuccessful();
    }
}
