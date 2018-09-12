<?php

declare(strict_types=1);

namespace App\Tests\Listener;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AskResetPasswordFormSubmittedListenerFunctionalTest extends WebTestCase
{
    public function testMailIsSentAndContentIsOk()
    {
        $client = static::createClient();

        $client->enableProfiler();

        $crawler = $client->request('GET','/resetpassword/ask');

        $form = $crawler->selectButton('Envoyer')->form();

        $form['ask_reset_password[username]'] = 'Toto';
        $form['ask_reset_password[email]'] = 'toto@gmail.com';

        $crawler = $client->submit($form);

        $mailCollector = $client->getProfile()->getCollector('swiftmailer');

        static::assertSame(1, $mailCollector->getMessageCount());

        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        // Asserting email data
        static::assertInstanceOf('Swift_Message', $message);
        static::assertSame('Réinitialisation du mot de passe', $message->getSubject());
        static::assertSame('bohnmaelle@gmail.com', key($message->getFrom()));
        static::assertSame('toto@gmail.com', key($message->getTo()));
        static::assertSame(
            'Hello !',
            $message->getBody()
        );
    }
}
