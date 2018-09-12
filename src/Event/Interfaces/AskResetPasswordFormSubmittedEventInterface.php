<?php

namespace App\Event\Interfaces;

use App\Domain\Models\Interfaces\UsersInterface;

interface AskResetPasswordFormSubmittedEventInterface
{
    const NAME = 'resetform.submitted';

    /**
     * AskResetPasswordFormSubmittedEvent constructor.
     *
     * @param UsersInterface $user
     */
    public function __construct(UsersInterface $user);

    /**
     * @return UsersInterface
     */
    public function getUser(): UsersInterface;
}