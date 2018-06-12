<?php

namespace App\Event\Interfaces;

use App\Domain\DTO\NewReservationFormSubmittedDTO;

interface ReservationFormSubmittedEventInterface
{
    const NAME = 'reservationform.submitted';

    public function __construct (NewReservationFormSubmittedDTO $newReservationFormSubmittedDTO);

    public function getNewReservationFormSubmittedDTO(): NewReservationFormSubmittedDTO;
}