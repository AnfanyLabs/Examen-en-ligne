<?php

namespace App\Tests\Controller\Candidat;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CandidatControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/candidat/candidat');

        self::assertResponseIsSuccessful();
    }
}
