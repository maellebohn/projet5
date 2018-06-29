<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\UI\Action\Interfaces\RegisterActionInterface;
use App\UI\Form\Handler\Interfaces\RegisterTypeHandlerInterface;
use App\UI\Form\Type\RegisterType;
use App\UI\Responder\Interfaces\RegisterResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/register",
 *     name="registration"
 * )
 */

final class RegisterAction implements RegisterActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RegisterTypeHandlerInterface
     */
    private $registerTypeHandler;

    /**
     * RegisterAction constructor.
     *
     * @param FormFactoryInterface         $formFactory
     * @param RegisterTypeHandlerInterface $registerTypeHandler
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RegisterTypeHandlerInterface $registerTypeHandler
    ) {
        $this->formFactory = $formFactory;
        $this->registerTypeHandler = $registerTypeHandler;
    }


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
    ) {
        $registerType = $this->formFactory->create(RegisterType::class)
                                           ->handleRequest($request);

        if($this->registerTypeHandler->handle($registerType)) {
            return $responder(true);
        }

        return $responder(false, $registerType);
    }
}
