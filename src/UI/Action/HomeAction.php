<?php

declare(strict_types=1);

namespace App\UI\Action;

use App\UI\Action\Interfaces\HomeActionInterface;
use App\UI\Responder\Interfaces\HomeResponderInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(
 *     path="/",
 *     name="home"
 * )
 */

class HomeAction implements HomeActionInterface
{
    /**
     * @param HomeResponderInterface $responder
     * @return mixed
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(HomeResponderInterface $responder)
    {
        return $responder();
    }
}
