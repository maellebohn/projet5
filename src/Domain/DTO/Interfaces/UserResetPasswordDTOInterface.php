<?php

declare(strict_types=1);

namespace App\Domain\DTO\Interfaces;

interface UserResetPasswordDTOInterface
{
    /**
     * UserResetPasswordDTO constructor.
     *
     * @param string $username
     * @param string $email
     */
    public function __construct(
        string $username,
        string $email
    );
}