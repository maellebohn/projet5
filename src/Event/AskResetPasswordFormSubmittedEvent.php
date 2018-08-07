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
     * {@inheritdoc}
     */
    public function __construct(UsersInterface $user)
    {
        $this->user = $user;
    }
    /**
     * {@inheritdoc}
     */
    public function getUser(): UsersInterface
    {
        return $this->user;
    }
}