<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordActionFunctionalTest extends WebTestCase
{
    public function testResetPasswordPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/resetpassword/ghjkizzkfejzejfizf');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testResetPasswordPageFormSubmission()
    {
        $client = static::createClient();

        $client->followRedirects();

        $crawler = $client->request('GET','/resetpassword/ghjkizzkfejzejfizf');

        $form = $crawler->selectButton('Envoyer')->form();

        $form['contact[name]'] = 'Toto';
        $form['contact[email]'] = 'toto@gmail.com';
        $form['contact[message]'] = 'Hello !' ;

        $client->submit($form);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}