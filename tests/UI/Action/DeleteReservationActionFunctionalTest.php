<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteReservationActionFunctionalTest extends WebTestCase
{
    public function testDeleteReservationPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/deletereservation/1e1796b3-8e1a-452e-85d5-2b0248ed3cde');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

}