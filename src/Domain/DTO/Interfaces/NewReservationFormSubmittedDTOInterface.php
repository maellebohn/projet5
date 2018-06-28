<?php

declare(strict_types=1);

namespace App\Domain\DTO\Interfaces;

interface NewReservationFormSubmittedDTOInterface
{
    /**
     * NewReservationFormSubmittedDTO constructor.
     *
     * @param string $name
     * @param string $email
     * @param string $message
     */
    public function __construct(
        string $name,
        string $email,
        string $message
    );
}