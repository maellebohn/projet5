<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\UI\Responder\Interfaces\LoginResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

interface LoginActionInterface
{
    /**
     * LoginAction constructor.
     *
     * @param AuthenticationUtils $authenticationUtils
     */
    public function __construct(AuthenticationUtils $authenticationUtils);

    /**
     * @param LoginResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(LoginResponderInterface $responder);
}
