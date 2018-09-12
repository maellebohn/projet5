<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\GetInfoResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class GetInfoResponder implements GetInfoResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * GetInfoResponder constructor.
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
            $this->twig->render('info.html.twig', [
                'infos' => $data
            ])
        );
    }
}