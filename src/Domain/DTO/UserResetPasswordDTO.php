<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\UserResetPasswordDTOInterface;

class UserResetPasswordDTO implements UserResetPasswordDTOInterface
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $email;

    /**
     * UserResetPasswordDTO constructor.
     *
     * @param string $username
     * @param string $email
     */
    public function __construct(
        string $username,
        string $email
    ) {
        $this->username = $username;
        $this->email = $email;
    }
}