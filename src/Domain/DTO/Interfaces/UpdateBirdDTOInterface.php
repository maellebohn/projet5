<?php

declare(strict_types=1);

namespace App\Domain\DTO\Interfaces;

interface UpdateBirdDTOInterface
{
    /**
     * UpdateBirdDTO constructor.
     *
     * @param string $name
     * @param int $birthdate
     * @param string $description
     * @param int    $price
     */
    public function __construct(
        string $name,
        int $birthdate,
        int $price,
        string $description
    );
}