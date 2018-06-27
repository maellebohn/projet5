<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AddBirdActionFunctionalTest extends WebTestCase
{
    public function testAddInfoPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/addbird');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testAddBirdPageFormSubmission()
    {
        $client = static::createClient();

        $crawler = $client->request('GET','/addbird');

        $form = $crawler->selectButton('Créer')->form();

        $form['add_bird[name]'] = 'inoue';
        $form['add_bird[birthdate]'] = '2018-02-05';
        $form['add_bird[price]'] = 200;
        $form['add_bird[description]'] = 'femelle';

        $crawler = $client->submit($form);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}