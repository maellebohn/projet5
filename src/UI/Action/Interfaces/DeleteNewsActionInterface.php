<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Responder\Interfaces\DeleteNewsResponderInterface;
use Symfony\Component\HttpFoundation\Request;

interface DeleteNewsActionInterface
{
    /**
     * DeleteNewsAction constructor.
     *
     * @param NewssRepositoryInterface $newsRepository
     */
    public function __construct (NewsRepositoryInterface $newsRepository);

    /**
     * @param Request $request
     * @param DeleteNewsResponderInterface $responder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function __invoke(
        Request $request,
        DeleteNewsResponderInterface $responder
    );
}
