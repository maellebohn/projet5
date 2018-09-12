<?php

declare(strict_types=1);

namespace App\UI\Form\Handler\Interfaces;

use App\Repository\Interfaces\UsersRepositoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface RegisterTypeHandlerInterface
{
    /**
     * RegisterTypeHandler constructor.
     *
     * @param EncoderFactoryInterface  $passwordEncoderFactory
     * @param UsersRepositoryInterface $usersRepository
     * @param ValidatorInterface       $validator
     * @param SessionInterface         $session
     */
    public function __construct (
        EncoderFactoryInterface $passwordEncoderFactory,
        UsersRepositoryInterface $usersRepository,
        ValidatorInterface $validator,
        SessionInterface $session
    );

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handle(FormInterface $form): bool;
}
