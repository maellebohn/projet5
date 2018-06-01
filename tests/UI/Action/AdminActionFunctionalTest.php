<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AdminActionFunctionalTest extends WebTestCase
{
    public function testAdminPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/admin');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}
