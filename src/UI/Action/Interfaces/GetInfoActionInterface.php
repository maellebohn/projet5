<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Responder\Interfaces\GetInfoResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface GetInfoActionInterface
{
    /**
     * GetInfoAction constructor.
     *
     * @param InfosRepositoryInterface $infosRepository
     */
    public function __construct (InfosRepositoryInterface $infosRepository);

    /**
     * @param Request                   $request
     * @param GetInfoResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(
        Request $request,
        GetInfoResponderInterface $responder
    );
}
