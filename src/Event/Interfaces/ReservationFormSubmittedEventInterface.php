<?php

namespace App\Event\Interfaces;

use App\Domain\DTO\NewReservationFormSubmittedDTO;

interface ReservationFormSubmittedEventInterface
{
    const NAME = 'reservationform.submitted';

    /**
     * ReservationFormSubmittedEvent constructor.
     *
     * @param NewReservationFormSubmittedDTO $newReservationFormSubmittedDTO
     */
    public function __construct (NewReservationFormSubmittedDTO $newReservationFormSubmittedDTO);

    /**
     * @return NewReservationFormSubmittedDTO
     */
    public function getNewReservationFormSubmittedDTO(): NewReservationFormSubmittedDTO;
}