<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\UI\Action\Interfaces\LoginActionInterface;
use App\UI\Responder\Interfaces\LoginResponderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route(
 *     path="/login",
 *     name="login",
 *     methods={"GET", "POST"}
 * )
 */
final class LoginAction implements LoginActionInterface
{
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    /**
     * LoginAction constructor.
     *
     * @param AuthenticationUtils $authenticationUtils
     */
    public function __construct(AuthenticationUtils $authenticationUtils)
    {
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * @param LoginResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(LoginResponderInterface $responder)
    {
        return $responder(
            $this->authenticationUtils->getLastAuthenticationError(),
            $this->authenticationUtils->getLastUsername()
        );
    }
}
