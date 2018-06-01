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
     * @param AdminResponderInterface   $responder
     * @param BirdsRepositoryInterface  $birdsRepository
     * @param NewsRepositoryInterface   $newsRepository
     */
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        AdminResponderInterface $responder,
        BirdsRepositoryInterface $birdsRepository,
        NewsRepositoryInterface $newsRepository
    );

    /**
     * @return mixed
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke();
}
