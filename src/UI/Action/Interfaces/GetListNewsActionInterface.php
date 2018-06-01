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
     * @param NewsRepositoryInterface       $newsRepository
     * @param GetListNewsResponderInterface $responder
     */
    public function __construct (
        NewsRepositoryInterface $newsRepository,
        GetListNewsResponderInterface $responder
    );

    /**
     * @return mixed
     */
    public function __invoke();
}
