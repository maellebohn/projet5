<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetInfoActionFunctionalTest extends WebTestCase
{
    public function testGetInfoPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/info/1001dfbe-05f3-47dd-a2cb-b1556dda37d6');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

}