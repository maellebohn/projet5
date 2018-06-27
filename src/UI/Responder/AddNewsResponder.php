<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\AddNewsResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class AddNewsResponder implements AddNewsResponderInterface
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
     *AddNewsResponder constructor.
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
     * @param bool               $redirect
     * @param FormInterface|null $addNewsType
     *
     * @return RedirectResponse|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $addNewsType = null)
    {
        $redirect
        ? $response = new RedirectResponse($this->router->generate('admin'))
        : $response = new Response(
            $this->twig->render('addnews.html.twig', [
                'form' => $addNewsType->createView()
            ])
        );

        return $response;
    }
}
