<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\UserNewPasswordDTOInterface;

class UserNewPasswordDTO implements UserNewPasswordDTOInterface
{
    /**
     * @var string
     */
    public $password;

    /**
     * UserNewPasswordDTO constructor.
     *
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }
}