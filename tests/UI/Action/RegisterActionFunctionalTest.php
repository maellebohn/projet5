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

        $client->followRedirects();

        $crawler = $client->request('GET','/register');

        $form = $crawler->selectButton('Créer')->form();

        $form['register[firstname]'] = 'Toto';
        $form['register[lastname]'] = 'Dupont';
        $form['register[username]'] = 'Tintin';
        $form['register[email]'] = 'toto@gmail.com';
        $form['register[password][first]'] = 'coco21';
        $form['register[password][second]'] = 'coco21';

        $client->submit($form);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}