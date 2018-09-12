<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteNewsActionFunctionalTest extends WebTestCase
{
    public function testGetStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/deletenews/id');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

}