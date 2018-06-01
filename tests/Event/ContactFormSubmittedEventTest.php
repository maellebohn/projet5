<?php

namespace App\Tests\Event;

use App\Domain\DTO\NewContactFormSubmittedDTO;
use App\Event\ContactFormSubmittedEvent;
use App\Event\Interfaces\ContactFormSubmittedEventInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ContactFormSubmittedEventTest extends KernelTestCase
{
    private $newContactFormSubmittedDTO;

    public function setUp ()
    {
        $this->newContactFormSubmittedDTO = $this->createMock(NewContactFormSubmittedDTO::class);
    }

    public function testConstruct()
    {
        $contactFormSubmittedEvent = new ContactFormSubmittedEvent(
            $this->newContactFormSubmittedDTO
        );

        static::assertInstanceOf(
            ContactFormSubmittedEventInterface::class,
            $contactFormSubmittedEvent
        );
    }
}