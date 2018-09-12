<?php

declare(strict_types=1);

namespace App\Domain\Models\Interfaces;

interface UsersInterface
{
    public function getId();

    public function getFirstname();

    public function getLastname();

    public function getUsername();

    public function getEmail();

    public function getPassword();

    public function getRoles();

    public function getDateCreation();

    public function getActive();

    public function getSalt();

    public function eraseCredentials();

    public function getResetPasswordToken();

    public function updatePassword(string $newPassword);
}
