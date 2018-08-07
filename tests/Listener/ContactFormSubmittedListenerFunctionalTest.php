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

        //requete en get, soumettre form et recup datacollector

        $crawler = $client->request('POST', '/contact');

        $mailCollector = $client->getProfile()->getCollector('swiftmailer');

        static::assertSame(1, $mailCollector->getMessageCount());

        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        // Asserting email data
        static::assertInstanceOf('Swift_Message', $message);
        static::assertSame('Hello Email', $message->getSubject());
        static::assertSame('send@example.com', key($message->getFrom()));
        static::assertSame('recipient@example.com', key($message->getTo()));
        static::assertSame(
            'You should see me from the profiler!',
            $message->getBody()
        );
    }
}
