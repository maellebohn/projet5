<?php

declare(strict_types=1);

namespace App\Helper\Interfaces;


interface TokenGeneratorHelperInterface
{
    public function generateResetPasswordToken(string $username, string $email): string;
}