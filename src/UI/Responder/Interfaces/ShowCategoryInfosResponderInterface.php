<?php

declare(strict_types=1);

namespace App\UI\Responder\Interfaces;

use Twig\Environment;

interface ShowCategoryInfosResponderInterface
{
    /**
     *ShowCategoryInfosResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig);

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke();
}
