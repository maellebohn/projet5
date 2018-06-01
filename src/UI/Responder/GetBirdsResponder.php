<?php

declare(strict_types=1);

namespace App\UI\Responder;

use App\UI\Responder\Interfaces\GetBirdsResponderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class GetBirdsResponder implements GetBirdsResponderInterface
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     *GetBirdsResponder constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param               $data
     * @param FormInterface $reservationType
     *
     * @return Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($data, FormInterface $reservationType)
    {
        return new Response(
            $this->twig->render('listbirds.html.twig', [
                'listbirds' =>$data,
                'form' => $reservationType->createView()
            ])
        );
    }
}