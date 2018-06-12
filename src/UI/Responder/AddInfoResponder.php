<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\AddInfoResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class AddInfoResponder implements AddInfoResponderInterface
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
     *AddInfoResponder constructor.
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
     * @param FormInterface|null $addInfoType
     *
     * @return RedirectResponse|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, FormInterface $addInfoType = null)
    {
        $redirect
        ? $response = new RedirectResponse($this->router->generate('add_info'))
        : $response = new Response(
            $this->twig->render('addinfo.html.twig', [
                'form' => $addInfoType->createView()
            ])
        );

        return $response;
    }
}
