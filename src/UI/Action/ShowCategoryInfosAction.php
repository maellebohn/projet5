<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\UI\Action\Interfaces\ShowCategoryInfosActionInterface;
use App\UI\Responder\Interfaces\ShowCategoryInfosResponderInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/conseils",
 *     name="conseils"
 * )
 */

final class ShowCategoryInfosAction implements ShowCategoryInfosActionInterface
{
    /**
     * @param ShowCategoryInfosResponderInterface $responder
     *
     * @return mixed
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(ShowCategoryInfosResponderInterface $responder)
    {
        return $responder();
    }
}
