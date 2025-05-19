<?php

namespace App\Tests\Controller\Enseignant;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class EnseignantControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/enseignant/enseignant');

        self::assertResponseIsSuccessful();
    }
}
