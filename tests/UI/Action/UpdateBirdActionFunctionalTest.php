<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UpdateBirdActionFunctionalTest extends WebTestCase
{
    public function testUpdateBirdPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/updatebird/1e1796b3-8e1a-452e-85d5-2b0248ed3cde');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testUpdateBirdPageFormSubmission()
    {
        $client = static::createClient();

        $client->followRedirects();

        $crawler = $client->request('GET','/updatebird/1e1796b3-8e1a-452e-85d5-2b0248ed3cde');

        $form = $crawler->selectButton('Créer')->form();

        $form['update_bird[name]'] = 'inoue';
        $form['update_bird[birthdate]'] = 1530741600;
        $form['update_bird[price]'] = 200;
        $form['update_bird[description]'] = 'femelle';

        $client->submit($form);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}