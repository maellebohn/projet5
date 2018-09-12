<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Responder\Interfaces\GetListNewsResponderInterface;

interface GetListNewsActionInterface
{
    /**
     * GetListNewsAction constructor.
     *
     * @param NewsRepositoryInterface $newsRepository
     */
    public function __construct (NewsRepositoryInterface $newsRepository);

    /**
     * @param GetListNewsResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(GetListNewsResponderInterface $responder);
}
