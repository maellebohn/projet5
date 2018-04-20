<?php

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeActionFunctionalTest extends WebTestCase
{
    public function testHomePageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}
