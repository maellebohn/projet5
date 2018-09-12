<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Domain\Models\Interfaces\UsersInterface;
use App\Repository\Interfaces\UsersRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

interface ResetPasswordTypeHandlerInterface
{
    /**
     * ResetPasswordTypeHandler constructor.
     *
     * @param UsersRepositoryInterface $usersRepository
     * @param SessionInterface         $session
     * @param EncoderFactoryInterface  $encoderFactory
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct (
        UsersRepositoryInterface $usersRepository,
        SessionInterface $session,
        EncoderFactoryInterface $encoderFactory,
        EventDispatcherInterface $eventDispatcher
    );

    /**
     * @param FormInterface  $form
     * @param UsersInterface $user
     *
     * @return bool
     */
    public function handle(FormInterface $form, UsersInterface $user): bool;
}
