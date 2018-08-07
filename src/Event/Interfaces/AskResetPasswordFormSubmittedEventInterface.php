<?php

namespace App\Event\Interfaces;

use App\Domain\Models\Interfaces\UsersInterface;

interface AskResetPasswordFormSubmittedEventInterface
{
    const NAME = 'resetform.submitted';

    public function __construct(UsersInterface $user);

    public function getUser();
}