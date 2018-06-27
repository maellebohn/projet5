<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\LoginResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class LoginResponder implements LoginResponderInterface
{
    /**
    * @var Environment
    */
    private $twig;

    /**
     *LoginResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param \Exception $exception
     * @param string     $username
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        \Exception $exception = null,
        string $username = null
    ) {
        return new Response(
            $this->twig->render('login.html.twig', [
                'username' => $username,
                'errors' => $exception
            ])
        );
    }
}
