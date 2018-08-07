<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\UI\Form\Handler\Interfaces\AskResetPasswordTypeHandlerInterface;
use App\UI\Responder\Interfaces\AskResetPasswordResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface AskResetPasswordActionInterface
{
    /**
     * AskResetPasswordActionInterface constructor.
     *
     * @param FormFactoryInterface                 $formFactory
     * @param AskResetPasswordTypeHandlerInterface $askResetPasswordTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        AskResetPasswordTypeHandlerInterface $askResetPasswordTypeHandler
    );

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
    );
}
