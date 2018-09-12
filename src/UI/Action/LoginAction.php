<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\UI\Action\Interfaces\LoginActionInterface;
use App\UI\Form\Type\LoginType;
use App\UI\Responder\Interfaces\LoginResponderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/login",
 *     name="login",
 * )
 */
final class LoginAction implements LoginActionInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * LoginAction constructor.
     *
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @param Request                 $request
     * @param LoginResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        LoginResponderInterface $responder
    ) {
        $loginType = $this->formFactory->create(LoginType::class)
                                         ->handleRequest($request);

        return $responder($loginType);
    }
}
