<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ContactActionFunctionalTest extends WebTestCase
{
    public function testContactPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/contact');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testContactPageFormSubmission()
    {
        $client = static::createClient();

        $crawler = $client->request('GET','/contact');

        $form = $crawler->selectButton('Envoyer')->form();

        $form['contact[name]'] = 'Toto';
        $form['contact[email]'] = 'toto@gmail.com';
        $form['contact[message]'] = 'Hello !' ;

        $crawler = $client->submit($form);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}