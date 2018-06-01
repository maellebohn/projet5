<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ShowCategoryInfosActionFunctionalTest extends WebTestCase
{
    public function testShowCategoryInfosPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/conseils');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}
