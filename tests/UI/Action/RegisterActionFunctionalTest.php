<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RegisterActionFunctionalTest extends WebTestCase
{
    public function testRegisterPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/register');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testRegisterPageFormSubmission()
    {
        $client = static::createClient();

        $crawler = $client->request('GET','/register');

        $form = $crawler->selectButton('Envoyer')->form();

        $form['register[firstname]'] = 'Toto';
        $form['register[lastname]'] = 'Dupont';
        $form['register[username]'] = 'Tintin';
        $form['register[email]'] = 'toto@gmail.com';
        $form['register[password]'] = 'coco21';
        //x2?

        $crawler = $client->submit($form);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}