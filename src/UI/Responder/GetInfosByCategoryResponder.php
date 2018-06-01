<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\GetInfosByCategoryResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class GetInfosByCategoryResponder implements GetInfosByCategoryResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     *GetInfosByCategoryResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param $data
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($data)
    {
        return new Response(
            $this->twig->render('infosbycategory.html.twig', [
                'infosbycategory' =>$data
            ])
        );
    }
}