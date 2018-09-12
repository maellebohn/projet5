<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\GetBirdsResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class GetBirdsResponder implements GetBirdsResponderInterface
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
     *GetBirdsResponder constructor.
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
     * @param                    $data
     * @param FormInterface|null $reservationType
     *
     * @return RedirectResponse|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        $redirect = false,
        $data,
        FormInterface $reservationType = null
    ) {
        $redirect
            ? $response = new RedirectResponse($this->router->generate('home'))
            : $response = new Response(
            $this->twig->render('listbirds.html.twig', [
                'listbirds' => $data,
                'form' => $reservationType->createView()
            ])
        );

        return $response;
    }
}