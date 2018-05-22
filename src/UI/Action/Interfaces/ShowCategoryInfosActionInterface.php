<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\UI\Responder\Interfaces\ShowCategoryInfosResponderInterface;

interface ShowCategoryInfosActionInterface
{
    /**
     * @param ShowCategoryInfosResponderInterface $responder
     * @return mixed
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ShowCategoryInfosResponderInterface $responder);
}
