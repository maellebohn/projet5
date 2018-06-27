<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetListNewsActionFunctionalTest extends WebTestCase
{
    public function testNewsPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/news');

        //dump($client->getResponse()->getContent()); no database selected, n'arrive pas a faire le query

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}
