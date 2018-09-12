<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Form\Handler\Interfaces\ResetPasswordTypeHandlerInterface;
use App\UI\Responder\Interfaces\ResetPasswordResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface ResetPasswordActionInterface
{
    /**
     * ResetPasswordAction constructor.
     *
     * @param FormFactoryInterface              $formFactory
     * @param ResetPasswordTypeHandlerInterface $resetPasswordTypeHandler
     * @param UsersRepositoryInterface          $usersRepository
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        ResetPasswordTypeHandlerInterface $resetPasswordTypeHandler,
        UsersRepositoryInterface $usersRepository
    );

    /**
     * @param Request                         $request
     * @param ResetPasswordResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        ResetPasswordResponderInterface $responder
    );
}
