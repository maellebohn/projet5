<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\ShowCategoryInfosResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowCategoryInfosResponder implements ShowCategoryInfosResponderInterface
{
    /**
    * @var Environment
    */
    private $twig;

    /**
    *ShowCategoryInfosResponder constructor.
    *
    * @param Environment $twig
    */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke()
    {
        return new Response(
            $this->twig->render('categoryinfos.html.twig')
        );
    }
}
