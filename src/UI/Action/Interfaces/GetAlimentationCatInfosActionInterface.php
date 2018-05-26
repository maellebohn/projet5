<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\InfosRepositoryInterface;
use App\UI\Responder\Interfaces\GetAlimentationCatInfosResponderInterface;

interface GetAlimentationCatInfosActionInterface
{
    public function __construct (
        InfosRepositoryInterface $birdsRepository,
        GetAlimentationCatInfosResponderInterface $responder
    );

    public function __invoke();
}
