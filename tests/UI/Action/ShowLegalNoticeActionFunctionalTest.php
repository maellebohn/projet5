<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ShowLegalNoticeActionFunctionalTest extends WebTestCase
{
    public function testShowLegalNoticePageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/mentionslegales');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}
