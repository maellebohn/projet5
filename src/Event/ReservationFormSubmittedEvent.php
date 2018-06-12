<?php

declare(strict_types=1);

namespace App\Event;

use App\Domain\DTO\NewReservationFormSubmittedDTO;
use App\Event\Interfaces\ReservationFormSubmittedEventInterface;
use Symfony\Component\EventDispatcher\Event;

class ReservationFormSubmittedEvent extends Event implements ReservationFormSubmittedEventInterface
{
    private $newReservationFormSubmittedDTO;

    /**
     * ReservationFormSubmittedEvent constructor.
     *
     * @param NewReservationFormSubmittedDTO $newReservationFormSubmittedDTO
     */
    public function __construct (NewReservationFormSubmittedDTO $newReservationFormSubmittedDTO)
    {
        $this->newReservationFormSubmittedDTO = $newReservationFormSubmittedDTO;
    }

    /**
     * @return NewReservationFormSubmittedDTO
     */
    public function getNewReservationFormSubmittedDTO(): NewReservationFormSubmittedDTO
    {
        return $this->newReservationFormSubmittedDTO;
    }
}