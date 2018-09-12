<?php

declare(strict_types=1);

namespace App\Tests\UI\Action;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AskResetPasswordActionFunctionalTest extends WebTestCase
{
    public function testContactPageStatusCode()
    {
        $client = static::createClient();

        $client->request('GET','/resetpassword/ask');

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testAskResetPasswordPageFormSubmission()
    {
        $client = static::createClient();

        $crawler = $client->request('GET','/resetpassword/ask');

        $form = $crawler->selectButton('Envoyer')->form();

        $form['ask_reset_password[name]'] = 'Toto';
        $form['ask_reset_password[email]'] = 'toto@gmail.com';

        $crawler = $client->submit($form);

        static::assertSame(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}