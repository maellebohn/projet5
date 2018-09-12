<?php

declare(strict_types=1);

namespace App\Tests\Listener;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactFormSubmittedListenerFunctionalTest extends WebTestCase
{
    public function testMailIsSentAndContentIsOk()
    {
        $client = static::createClient();

        $client->enableProfiler();

        $crawler = $client->request('GET','/contact');

        $form = $crawler->selectButton('Envoyer')->form();

        $form['contact[name]'] = 'Toto';
        $form['contact[email]'] = 'toto@gmail.com';
        $form['contact[message]'] = 'Hello !' ;

        $crawler = $client->submit($form);

        $mailCollector = $client->getProfile()->getCollector('swiftmailer');

        static::assertSame(1, $mailCollector->getMessageCount());

        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        // Asserting email data
        static::assertInstanceOf('Swift_Message', $message);
        static::assertSame('Contact Email', $message->getSubject());
        static::assertSame('toto@gmail.com', key($message->getFrom()));
        static::assertSame('bohnmaelle@gmail.com', key($message->getTo()));
        static::assertSame(
            'Hello !',
            $message->getBody()
        );
    }
}
