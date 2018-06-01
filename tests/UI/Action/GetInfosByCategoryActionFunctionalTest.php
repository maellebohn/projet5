<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetInfosByCategoryActionFunctionalTest extends WebTestCase
{
    public function testReservationPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/conseils/{category}');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}
