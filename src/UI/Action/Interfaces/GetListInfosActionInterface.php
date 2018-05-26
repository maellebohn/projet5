<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Responder\Interfaces\GetListInfosResponderInterface;

interface GetListInfosActionInterface
{
    public function __construct (
        InfosRepositoryInterface $infosRepository,
        GetListInfosResponderInterface $responder,
        BirdsRepositoryInterface $birdsRepository
    );

    public function __invoke();
}
