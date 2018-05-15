<?php

declare(strict_types=1);

namespace App\UI\Responder\Interfaces;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

interface AddInfoResponderInterface
{
    /**
     * AddInfoResponderInterface constructor.
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
     * @param FormInterface|null $addInfoType
     * @return mixed
     */
    public function __invoke(
        $redirect = false,
        FormInterface $addInfoType = null
    );
}
