<?php

namespace App\Tests\Event;

use App\Domain\DTO\NewContactFormSubmittedDTO;
use App\Event\ContactFormSubmittedEvent;
use App\Event\Interfaces\ContactFormSubmittedEventInterface;
use PHPUnit\Framework\TestCase;

class ContactFormSubmittedEventTest extends TestCase
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

    public function testGetter()
    {
        $contactFormSubmittedEvent = new ContactFormSubmittedEvent(
            $this->newContactFormSubmittedDTO
        );

        static::assertSame($this->newContactFormSubmittedDTO, $contactFormSubmittedEvent->getnewContactFormSubmittedDTO());
    }
}