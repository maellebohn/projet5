<?php

declare(strict_types=1);

namespace App\Helper;

use App\Helper\Interfaces\TokenGeneratorHelperInterface;

class TokenGeneratorHelper implements TokenGeneratorHelperInterface
{
    public function generateResetPasswordToken(string $username, string $email): string
    {
        return substr(
            crypt(md5(str_rot13($username)), $email),
            0,
            10
        );
    }
}