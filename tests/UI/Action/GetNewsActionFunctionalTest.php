<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetNewsActionFunctionalTest extends WebTestCase
{
    public function testGetNewsPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/news/382fe3d5-8cb5-4481-823f-299d8551d451');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

}