<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Action\Interfaces\ResetPasswordActionInterface;
use App\UI\Form\Handler\Interfaces\ResetPasswordTypeHandlerInterface;
use App\UI\Form\Type\ResetPasswordType;
use App\UI\Responder\Interfaces\ResetPasswordResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/resetpassword/{token}",
 *     name="reset_password",
 *     requirements={
 *         "token": "\S+"
 *     }
 * )
 */
final class ResetPasswordAction implements ResetPasswordActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ResetPasswordTypeHandlerInterface
     */
    private $resetPasswordTypeHandler;

    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

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
    ) {
        $this->formFactory = $formFactory;
        $this->resetPasswordTypeHandler = $resetPasswordTypeHandler;
        $this->usersRepository = $usersRepository;
    }

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
    ) {
        $user = $this->usersRepository->getUserByResetPasswordToken($request->attributes->get('token'));

        $resetPasswordType = $this->formFactory->create(ResetPasswordType::class)
                                         ->handleRequest($request);

        if($this->resetPasswordTypeHandler->handle($resetPasswordType, $user)) {
            return $responder(true);
        }

        return $responder(false, $resetPasswordType);
    }
}
