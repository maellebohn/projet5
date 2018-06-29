<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\UI\Form\Handler\Interfaces\RegisterTypeHandlerInterface;
use App\UI\Responder\Interfaces\RegisterResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

interface RegisterActionInterface
{
    /**
     * RegisterAction constructor.
     *
     * @param FormFactoryInterface         $formFactory
     * @param RegisterTypeHandlerInterface $registerTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RegisterTypeHandlerInterface $registerTypeHandler
    );

    /**
     * @param Request                    $request
     * @param RegisterResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        RegisterResponderInterface $responder
    );
}
