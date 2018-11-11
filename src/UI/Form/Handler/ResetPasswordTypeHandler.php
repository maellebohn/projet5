<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;


use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\Users;
use App\Event\AskResetPasswordFormSubmittedEvent;
use App\Event\Interfaces\AskResetPasswordFormSubmittedEventInterface;
use App\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Form\Handler\Interfaces\ResetPasswordTypeHandlerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class ResetPasswordTypeHandler implements ResetPasswordTypeHandlerInterface
{
    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

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
    ) {
        $this->usersRepository = $usersRepository;
        $this->session = $session;
        $this->encoderFactory = $encoderFactory;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param FormInterface  $form
     * @param UsersInterface $user
     *
     * @return bool
     */
    public function handle(FormInterface $form, UsersInterface $user): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            $user->resetPasswordDate();
            $interval = $user->getAskResetPasswordDate()->diff($user->getResetPasswordDate());

            if (($interval->hours) >= 24) {

                $user->updateAskResetPasswordDate();
                $this->usersRepository->update();

                $this->eventDispatcher->dispatch(AskResetPasswordFormSubmittedEventInterface::NAME, new AskResetPasswordFormSubmittedEvent($user));

                $this->session->getFlashBag()->add('success', 'Lien de réinitialisation non valide, Une demande de réinitialisation du mot de passe vous a été envoyée à nouveau par email !');

                return false;
            }
                $encoder = $this->encoderFactory->getEncoder(Users::class);
                $passwordEncoder = \Closure::fromCallable([$encoder, 'encodePassword']);

                $user->updatePassword($passwordEncoder($form->getData()->password, null));

                $this->usersRepository->update();

                $this->session->getFlashBag()->add('success', 'Réinitialisation du mot de passe réussie');

            return true;
        }
        return false;
    }
}
