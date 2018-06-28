<?php

declare(strict_types=1);

namespace App\Domain\DTO\Interfaces;

interface UpdateBirdDTOInterface
{
    /**
     * UpdateBirdDTO constructor.
     *
     * @param string $name
     * @param string $birthdate
     * @param string $description
     * @param int    $price
     */
    public function __construct(
        string $name,
        string $birthdate,
        string $description,
        int $price
    );
}