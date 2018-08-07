<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\UI\Action\Interfaces\AskResetPasswordActionInterface;
use App\UI\Form\Handler\Interfaces\AskResetPasswordTypeHandlerInterface;
use App\UI\Form\Type\AskResetPasswordType;
use App\UI\Responder\Interfaces\AskResetPasswordResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/resetpassword/ask",
 *     name="ask_reset_password"
 * )
 */
final class AskResetPasswordAction implements AskResetPasswordActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var askResetPasswordTypeHandlerInterface
     */
    private $askResetPasswordTypeHandler;

    /**
     * AskResetPasswordAction constructor.
     *
     * @param FormFactoryInterface                 $formFactory
     * @param AskResetPasswordTypeHandlerInterface $askResetPasswordTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AskResetPasswordTypeHandlerInterface $askResetPasswordTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->askResetPasswordTypeHandler = $askResetPasswordTypeHandler;
    }


    /**
     * @param Request                            $request
     * @param AskResetPasswordResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        AskResetPasswordResponderInterface $responder
    ) {
        $askResetPasswordType = $this->formFactory->create(AskResetPasswordType::class)
                                         ->handleRequest($request);

        if($this->askResetPasswordTypeHandler->handle($askResetPasswordType)) {
            return $responder(true);
        }

        return $responder(false, $askResetPasswordType);
    }
}
