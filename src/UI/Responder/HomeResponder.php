<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\HomeResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class HomeResponder implements HomeResponderInterface
{
    /**
    * @var Environment
    */
    private $twig;

    /**
    *HomeResponder constructor.
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
            $this->twig->render('index.html.twig')
        );
    }
}
