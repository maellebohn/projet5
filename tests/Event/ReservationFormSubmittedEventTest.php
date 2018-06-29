<?php

namespace App\Tests\Event;

use App\Domain\DTO\NewReservationFormSubmittedDTO;
use App\Event\ReservationFormSubmittedEvent;
use App\Event\Interfaces\ReservationFormSubmittedEventInterface;
use PHPUnit\Framework\TestCase;

class ReservationFormSubmittedEventTest extends TestCase
{
    private $newReservationFormSubmittedDTO;

    public function setUp ()
    {
        $this->newReservationFormSubmittedDTO = $this->createMock(NewReservationFormSubmittedDTO::class);
    }

    public function testConstruct()
    {
        $reservationFormSubmittedEvent = new ReservationFormSubmittedEvent(
            $this->newReservationFormSubmittedDTO
        );

        static::assertInstanceOf(
            ReservationFormSubmittedEventInterface::class,
            $reservationFormSubmittedEvent
        );
    }

    public function testGetter()
    {
        $reservationFormSubmittedEvent = new ReservationFormSubmittedEvent(
            $this->newReservationFormSubmittedDTO
        );

        static::assertSame($this->newReservationFormSubmittedDTO, $reservationFormSubmittedEvent->getnewReservationFormSubmittedDTO());
    }
}