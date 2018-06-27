<?php

declare(strict_types=1);

namespace App\UI\Responder\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface UpdateBirdResponderInterface
{
    /**
     * UpdateBirdResponderInterface constructor.
     *
     * @param Environment           $twig
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $router
    );

    public function __invoke(
        $redirect = false,
        $bird,
        FormInterface $updateBirdType = null
    );
}
