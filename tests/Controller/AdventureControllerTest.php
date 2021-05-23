<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdventureControllerTest extends WebTestCase
{
    private $postData;

    public function testAdventureControllePlayGameRoute()
    {
        $client = static::createClient();
        $client->request('GET', '/adventure/play');

        $this->assertResponseIsSuccessful();
    }

    public function testAdventureControllerSetupRoute()
    {
        $this->postData = ["playerName" => "none"];
        $client = static::createClient();
        $client->followRedirects();
        $client->request('POST', '/adventure/setup', $this->postData);

        $this->assertResponseIsSuccessful();
    }

    public function testAdventureControllerMoveRoute()
    {
        $this->postData = ["roomIndex" => "roomOne", "playerName" => "none"];
        $client = static::createClient();
        $client->followRedirects();
        $client->request('POST', '/adventure/setup', $this->postData);
        $client->request('POST', '/adventure/move', $this->postData);

        $this->assertResponseIsSuccessful();
    }

    public function testAdventureControllerPickUpRoute()
    {
        $this->postData = ["itemId" => "none", "playerName" => "none"];
        $client = static::createClient();
        $client->followRedirects();
        $client->request('POST', '/adventure/setup', $this->postData);
        $client->request('POST', '/adventure/pick', $this->postData);

        $this->assertResponseIsSuccessful();
    }

    public function testAdventureControllerUseRoute()
    {
        $this->postData = ["itemId" => "none", "roomIndex" => "roomOne", "playerName" => "none"];
        $client = static::createClient();
        $client->followRedirects();
        $client->request('POST', '/adventure/setup', $this->postData);
        $client->request('POST', '/adventure/use', $this->postData);

        $this->assertResponseIsSuccessful();
    }

    public function testAdventureControllerEndGameRoute()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('POST', '/adventure/end');

        $this->assertResponseIsSuccessful();
    }

    public function testAdventureControllerPlayGameAfterSetupUse()
    {
        $this->postData = ["itemId" => "none", "roomIndex" => "roomOne", "playerName" => "none"];
        $client = static::createClient();
        $client->followRedirects();
        $client->request('POST', '/adventure/setup', $this->postData);
        $client->request('POST', '/adventure/use', $this->postData);
        $client->request('POST', '/adventure/play');

        $this->assertResponseIsSuccessful();
    }
}
