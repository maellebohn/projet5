<?php

declare(strict_types=1);

namespace App\UI\Action\Interfaces;

use App\Repository\Interfaces\BirdsRepositoryInterface;
use App\UI\Responder\Interfaces\GetBirdsResponderInterface;

interface GetBirdsActionInterface
{
    public function __construct (
        BirdsRepositoryInterface $birdsRepository,
        GetBirdsResponderInterface $responder
    );

    public function __invoke();
}
