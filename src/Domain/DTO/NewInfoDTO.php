<?php

namespace App\Domain\DTO;

class NewInfoDTO
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
     * NewContactFormSubmittedDTO constructor.
     * @param string $name
     * @param string $email
     * @param string $message
     */
    public function __construct (string $name, string $email, string $message)
    {
        $this->name = $name;
        $this-> email = $email;
        $this->message =  $message;
    }
}