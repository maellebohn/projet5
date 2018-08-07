<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Users;
use App\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Form\Handler\Interfaces\ResetPasswordTypeHandlerInterface;
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

    public function __construct (
        UsersRepositoryInterface $usersRepository,
        SessionInterface $session
    ) {
        $this->usersRepository = $usersRepository;
        $this->session = $session;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {


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
