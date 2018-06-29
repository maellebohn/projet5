<?php

declare(strict_types=1);

namespace App\Tests\Listener;

use App\Event\ContactFormSubmittedEvent;
use App\Listener\ContactFormSubmittedListener;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class ContactFormSubmittedListenerTest extends TestCase
{
    public function testConstruct ()
    {
        $mailerMock = $this->createMock(\Swift_Mailer::class);
        $twigMock = $this->createMock(Environment::class);

        $contactFormSubmittedListener = new ContactFormSubmittedListener($mailerMock, $twigMock);


        static::assertClassHasAttribute(
            'mailer',
            ContactFormSubmittedListener::class
        );

        static::assertInstanceOf(
            ContactFormSubmittedListener::class,
            $contactFormSubmittedListener
        );
    }

    public function testContactFormSubmittedEventIsListened()
    {
        $mailerMock = $this->createMock(\Swift_Mailer::class);
        $twigMock = $this->createMock(Environment::class);

        $contactFormSubmittedListener = new ContactFormSubmittedListener($mailerMock, $twigMock);

        //test fonctionnel de l'envoi du mail
    }
}