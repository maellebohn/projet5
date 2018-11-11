<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UpdateNewsActionFunctionalTest extends WebTestCase
{
    public function testUpdateNewsPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/updatenews/1e1796b3-8e1a-452e-85d5-2b0248ed3cde');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testUpdateNewsPageFormSubmission()
    {
        $client = static::createClient();

        $client->followRedirects();

        $crawler = $client->request('GET','/updatenews/1e1796b3-8e1a-452e-85d5-2b0248ed3cde');

        $form = $crawler->selectButton('Créer')->form();

        $form['update_news[title]'] = 'alimentation';
        $form['update_news[image]'] = null;
        $form['update_news[content]'] = 'bien nourrir ses perroquets';

        $client->submit($form);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}