<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\NewsRepositoryInterface;
use App\UI\Responder\Interfaces\GetListNewsResponderInterface;

interface GetListNewsActionInterface
{
    public function __construct (
        NewsRepositoryInterface $infosRepository,
        GetListNewsResponderInterface $responder
    );

    public function __invoke();
}
