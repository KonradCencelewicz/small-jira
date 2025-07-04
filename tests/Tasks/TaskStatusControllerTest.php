<?php

namespace App\Tests\Tasks\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class TaskStatusControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/task/status');

        self::assertResponseIsSuccessful();
    }
}
