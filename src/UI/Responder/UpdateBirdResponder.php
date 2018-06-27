<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\UpdateBirdResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

final class UpdateBirdResponder implements UpdateBirdResponderInterface
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
     * UpdateNewsResponder constructor.
     *
     * @param Environment $twig
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
     * @param                    $bird
     * @param FormInterface|null $updateBirdType
     *
     * @return RedirectResponse|Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($redirect = false, $bird, FormInterface $updateBirdType = null)
    {
        $redirect
        ? $response = new RedirectResponse($this->router->generate('admin'))
        : $response = new Response(
            $this->twig->render('updatebird.html.twig', [
                'bird' => $bird,
                'form' => $updateBirdType->createView()
            ])
        );

        return $response;
    }
}
