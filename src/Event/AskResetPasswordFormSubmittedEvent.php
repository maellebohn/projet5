<?php

declare(strict_types=1);

namespace App\Event;

use App\Domain\Models\Interfaces\UsersInterface;
use App\Event\Interfaces\AskResetPasswordFormSubmittedEventInterface;
use Symfony\Component\EventDispatcher\Event;

class AskResetPasswordFormSubmittedEvent extends Event implements AskResetPasswordFormSubmittedEventInterface
{
    /**
     * @var UsersInterface
     */
    private $user;

    /**
     * AskResetPasswordFormSubmittedEvent constructor.
     *
     * @param UsersInterface $user
     */
    public function __construct(UsersInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @return UsersInterface
     */
    public function getUser(): UsersInterface
    {
        return $this->user;
    }
}