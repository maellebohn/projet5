<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Responder\Interfaces\AdminResponderInterface;

interface AdminActionInterface
{
    /**
     * AdminAction constructor.
     *
     * @param InfosRepositoryInterface  $infosRepository
     * @param BirdsRepositoryInterface  $birdsRepository
     * @param NewsRepositoryInterface   $newsRepository
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        BirdsRepositoryInterface $birdsRepository,
        NewsRepositoryInterface $newsRepository
    );

    /**
     * @param AdminResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(AdminResponderInterface $responder);
}
