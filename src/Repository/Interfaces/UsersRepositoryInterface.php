<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use App\Domain\Models\Interfaces\UsersInterface;

interface UsersRepositoryInterface
{
    public function save(UsersInterface $user);

    public function update();

    public function getUserByUsernameAndEmail(string $username, string $email);

    public function getUserByResetPasswordToken(string $token);
}