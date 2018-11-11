<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LoginActionFunctionalTest extends WebTestCase
{
    public function testLoginPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/login');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}