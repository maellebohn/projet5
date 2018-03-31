<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
* @Route(
  *    path="/",
  *    methods={"GET"}
  * )
**/

class DefaultController
{
    public function __invoke(Environment $environment)
    {
        return new Response(
            $environment->render('index.html.twig')
        );
    }
}
