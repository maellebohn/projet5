<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Responder\Interfaces\GetInfosByCategoryResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface GetInfosByCategoryActionInterface
{
    /**
     * GetInfosByCategoryAction constructor.
     *
     * @param InfosRepositoryInterface             $infosRepository
     * @param GetInfosByCategoryResponderInterface $responder
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        GetInfosByCategoryResponderInterface $responder
    );

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(Request $request);
}
