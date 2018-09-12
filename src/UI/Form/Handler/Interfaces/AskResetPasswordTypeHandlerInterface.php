<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Helper\Interfaces\TokenGeneratorHelperInterface;
use App\Repository\Interfaces\UsersRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface AskResetPasswordTypeHandlerInterface
{

    /**
     * AskResetPasswordTypeHandler constructor.
     *
     * @param UsersRepositoryInterface      $usersRepository
     * @param EventDispatcherInterface      $eventDispatcher
     * @param SessionInterface              $session
     * @param TokenGeneratorHelperInterface $tokenGeneratorHelper
     */
    public function __construct (
        UsersRepositoryInterface $usersRepository,
        EventDispatcherInterface $eventDispatcher,
        SessionInterface $session,
        TokenGeneratorHelperInterface $tokenGeneratorHelper
    );

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
