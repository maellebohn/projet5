<?php

declare(strict_types=1);

namespace App\Domain\DTO\Interfaces;

interface NewBirdDTOInterface
{
    /**
     * NewBirdDTO constructor.
     *
     * @param string $name
     * @param int    $birthdate
     * @param int    $price
     * @param string $description

     */
    public function __construct(
        string $name,
        int $birthdate,
        int $price,
        string $description
    );
}