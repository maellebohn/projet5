<?php

declare(strict_types=1);

namespace App\Domain\DTO\Interfaces;

interface UserRegistrationDTOInterface
{
    /**
     * UserRegistrationDTO constructor.
     *
     * @param string $firstname
     * @param string $lastname
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(
        string $firstname,
        string $lastname,
        string $username,
        string $email,
        string $password
    );
}