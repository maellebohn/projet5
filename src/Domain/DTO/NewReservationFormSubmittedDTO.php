<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\NewReservationFormSubmittedDTOInterface;

class NewReservationFormSubmittedDTO implements NewReservationFormSubmittedDTOInterface
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $message;

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
    ) {
        $this->name = $name;
        $this-> email = $email;
        $this->message =  $message;
    }
}