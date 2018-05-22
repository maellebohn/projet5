<?php

declare(strict_types=1);

namespace App\UI\Responder\Interfaces;

use Twig\Environment;

interface GetListInfosResponderInterface
{
    public function __construct(Environment $twig);

    public function __invoke($data);
}
