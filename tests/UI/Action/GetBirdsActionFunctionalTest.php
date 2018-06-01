<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetBirdsActionFunctionalTest extends WebTestCase
{
    public function testReservationPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/reservation');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}
