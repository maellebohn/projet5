<?php

declare(strict_types=1);

namespace App\UI\Responder\Interfaces;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface DeleteNewsResponderInterface
{
    /**
     *DeleteNewsResponder constructor.
     *
     * @param Environment $twig
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $router
    );

    /**
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function __invoke();
}
