<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetInfosByCategoryActionFunctionalTest extends WebTestCase
{
    public function testInfosByCategoryPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/conseils/alimentation');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}
