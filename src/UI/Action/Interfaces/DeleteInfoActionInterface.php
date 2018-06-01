<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Responder\Interfaces\DeleteInfoResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface DeleteInfoActionInterface
{
    /**
     * DeleteInfoAction constructor.
     *
     * @param InfosRepositoryInterface $infosRepository
     */
    public function __construct (InfosRepositoryInterface $infosRepository);

    /**
     * @param Request $request
     * @param DeleteInfoResponderInterface $responder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function __invoke(
        Request $request,
        DeleteInfoResponderInterface $responder
    );
}
