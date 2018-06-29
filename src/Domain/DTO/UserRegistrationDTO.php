<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\UserRegistrationDTOInterface;

class UserRegistrationDTO implements UserRegistrationDTOInterface
{
    /**
     * @var string
     */
    public $firstname;

    /**
     * @var string
     */
    public $lastname;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $password;

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
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}