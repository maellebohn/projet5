<?php

declare(strict_types=1);

namespace App\UI\Form\Handler;

use App\Domain\Models\Users;
use App\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Form\Handler\Interfaces\RegisterTypeHandlerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterTypeHandler implements RegisterTypeHandlerInterface
{
    /**
     * @var EncoderFactoryInterface
     */
    private $passwordEncoderFactory;

    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var SessionInterface
     */
    private $session;


    public function __construct (
        EncoderFactoryInterface $passwordEncoderFactory,
        UsersRepositoryInterface $usersRepository,
        ValidatorInterface $validator,
        SessionInterface $session
    ) {
        $this->passwordEncoderFactory = $passwordEncoderFactory;
        $this->usersRepository = $usersRepository;
        $this->validator = $validator;
        $this->session = $session;
    }

    /**
     * @param FormInterface $form
     * @return bool
     */
    public function handle(FormInterface $form): bool
    {
        if($form->isSubmitted() && $form->isValid()) {

            $encoder = $this->passwordEncoderFactory->getEncoder(Users::class);

            $user = new Users(
                $form->getData()->firstname,
                $form->getData()->lastname,
                $form->getData()->username,
                $form->getData()->email,
                $form->getData()->password,
                \Closure::fromCallable([$encoder, 'encodePassword'])
            );

            $this->validator->validate($user, [], [
                'registration'
            ]);

            $this->session->getFlashBag()->add('success', 'Votre compte a bien été crée !');

            $this->usersRepository->save($user);

            return true;
        }
        return false;
    }
}
