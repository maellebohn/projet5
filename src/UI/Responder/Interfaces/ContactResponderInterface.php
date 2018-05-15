<?php

declare(strict_types=1);

namespace App\UI\Responder\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface ContactResponderInterface
{
    /**
     * ContactResponderInterface constructor.
     *
     * @param Environment           $twig
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        Environment $twig,
        UrlGeneratorInterface $router
    );

    /**
     * @param bool               $redirect
     * @param FormInterface|null $contactType
     * @return mixed
     */
    public function __invoke(
        $redirect = false,
        FormInterface $contactType = null
    );
}
