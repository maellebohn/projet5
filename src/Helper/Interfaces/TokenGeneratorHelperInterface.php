<?php

declare(strict_types=1);

namespace App\Helper\Interfaces;


interface TokenGeneratorHelperInterface
{
    /**
     * @param string $username
     * @param string $email
     *
     * @return string
     */
    public function generateResetPasswordToken(string $username, string $email): string;
}