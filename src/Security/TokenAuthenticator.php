<?php

declare(strict_types=1);

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class TokenAuthenticator extends AbstractFormLoginAuthenticator
{
    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfTokenManager;

    public function __construct (
        UrlGeneratorInterface $router,
        UserPasswordEncoderInterface $userPasswordEncoder,
        CsrfTokenManagerInterface $csrfTokenManager
    ) {
        $this->router = $router;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function supports (Request $request)
    {
        return (($request->attributes->get("_route") === "login") && ($request->isMethod("POST"))) ? true : false;
    }

    public function getCredentials (Request $request)
    {
        if((!$request->request->get('login')['username']) && (!$request->request->get('login')['password'])){
            return null;
        }

        return [
            'username' => $request->request->get('login')['username'],
            'password' => $request->request->get('login')['password']
        ];
    }

    public function getUser ($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials["username"]);
    }

    public function checkCredentials ($credentials, UserInterface $user)
    {
        return ($this->userPasswordEncoder->isPasswordValid($user, $credentials["password"])) ? true : false;
    }

    public function onAuthenticationSuccess (Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse(
            $this->router->generate('admin')
        );
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // Store exception in the session.
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);

        // Redirect to login page.
        return new RedirectResponse(
            $this->router->generate('login')
        );
    }

    protected function getLoginUrl ()
    {
        return new RedirectResponse(
            $this->router->generate('login')
        );
    }
}