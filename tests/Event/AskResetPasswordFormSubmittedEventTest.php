<?php

namespace App\Tests\Event;

use App\Domain\Models\Interfaces\UsersInterface;
use App\Event\AskResetPasswordFormSubmittedEvent;
use App\Event\Interfaces\AskResetPasswordFormSubmittedEventInterface;
use PHPUnit\Framework\TestCase;

class AskResetPasswordFormSubmittedEventTest extends TestCase
{
    private $user;

    public function setUp ()
    {
        $this->user = $this->createMock(UsersInterface::class);
    }

    public function testConstruct()
    {
        $askResetPasswordFormSubmittedEvent = new AskResetPasswordFormSubmittedEvent(
            $this->user
        );

        static::assertInstanceOf(
            AskResetPasswordFormSubmittedEventInterface::class,
            $askResetPasswordFormSubmittedEvent
        );
    }

    public function testGetter()
    {
        $askResetPasswordFormSubmittedEvent = new AskResetPasswordFormSubmittedEvent(
            $this->user
        );

        static::assertSame($this->user, $askResetPasswordFormSubmittedEvent->getUser());
    }
}