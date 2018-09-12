<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Event\AskResetPasswordFormSubmittedEvent;
use App\Event\Interfaces\AskResetPasswordFormSubmittedEventInterface;
use App\Helper\Interfaces\TokenGeneratorHelperInterface;
use App\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Form\Handler\Interfaces\AskResetPasswordTypeHandlerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AskResetPasswordTypeHandler implements AskResetPasswordTypeHandlerInterface
{
    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var TokenGeneratorHelperInterface
     */
    private $tokenGeneratorHelper;

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
    ) {
        $this->usersRepository = $usersRepository;
        $this->eventDispatcher = $eventDispatcher;
        $this->session = $session;
        $this->tokenGeneratorHelper = $tokenGeneratorHelper;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            $user = $this->usersRepository->getUserByUsernameAndEmail(
                $form->getData()->username,
                $form->getData()->email
            );

            $userResetPasswordToken = $this->tokenGeneratorHelper->generateResetPasswordToken(
                $form->getData()->username,
                $form->getData()->email
            );

            $user->askForPasswordReset($userResetPasswordToken);

            $this->usersRepository->update();

            $this->eventDispatcher->dispatch(AskResetPasswordFormSubmittedEventInterface::NAME, new AskResetPasswordFormSubmittedEvent($user));

            $this->session->getFlashBag()->add('success', 'Une demande de réinitialisation du mot de passe vous a été envoyée par email !');

            return true;
        }
        return false;
    }
}
