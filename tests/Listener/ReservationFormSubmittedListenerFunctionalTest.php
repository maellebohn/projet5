<?php

declare(strict_types=1);

namespace App\Tests\Listener;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationFormSubmittedListenerFunctionalTest extends WebTestCase
{
    public function testMailIsSentAndContentIsOk()
    {
        $client = static::createClient();

        $client->enableProfiler();

        $crawler = $client->request('GET','/reservation');

        $form = $crawler->selectButton('Envoyer')->form();

        $form['reservation[name]'] = 'Toto';
        $form['reservation[email]'] = 'toto@gmail.com';
        $form['reservation[message]'] = 'Hello !' ;

        $crawler = $client->submit($form);

        $mailCollector = $client->getProfile()->getCollector('swiftmailer');

        static::assertSame(1, $mailCollector->getMessageCount());

        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        // Asserting email data
        static::assertInstanceOf('Swift_Message', $message);
        static::assertSame('Reservation Email', $message->getSubject());
        static::assertSame('toto@gmail.com', key($message->getFrom()));
        static::assertSame('bohnmaelle@gmail.com', key($message->getTo()));
        static::assertSame(
            'Hello !',
            $message->getBody()
        );
    }
}
