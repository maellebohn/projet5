<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\AdminResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class AdminResponder implements AdminResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     *AdminResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param $data
     * @param $data2
     * @param $data3
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($data, $data2, $data3)
    {
        return new Response(
            $this->twig->render('admin.html.twig', [
                'listinfos' => $data,
                'listnews' => $data2,
                'listbirds' => $data3
            ])
        );
    }
}