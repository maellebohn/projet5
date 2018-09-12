<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Responder\Interfaces\GetNewsResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface GetNewsActionInterface
{
    /**
     * GetNewsAction constructor.
     *
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct (NewsRepositoryInterface $newsRepository);

    /**
     * @param Request                   $request
     * @param GetNewsResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        GetNewsResponderInterface $responder
    );
}
