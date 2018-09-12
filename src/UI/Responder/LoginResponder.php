<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\LoginResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class LoginResponder implements LoginResponderInterface
{
    /**
    * @var Environment
    */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     *LoginResponder constructor.
     *
     * @param Environment           $twig
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $router
    ) {
        $this->twig = $twig;
        $this->router = $router;
    }

    /**
     * @param FormInterface $loginType
     *
     * @return RedirectResponse|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(FormInterface $loginType)
    {
        return new Response(
            $this->twig->render('login.html.twig', [
                'form' => $loginType->createView()
            ])
        );
    }
}
