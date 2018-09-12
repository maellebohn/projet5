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
     * @var string
     */
    public $id;

    /**
     * NewReservationFormSubmittedDTO constructor.
     *
     * @param string $name
     * @param string $email
     * @param string $message
     * @param string $id
     */
    public function __construct(
        string $name,
        string $email,
        string $message,
        string $id
    ) {
        $this->name = $name;
        $this-> email = $email;
        $this->message =  $message;
        $this->id = $id;
    }
}