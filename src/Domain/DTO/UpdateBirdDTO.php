<?php

declare(strict_types=1);

namespace App\Domain\DTO;

class UpdateBirdDTO
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $birthdate;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $price;

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
    ) {
        $this->name = $name;
        $this->birthdate = $birthdate;
        $this->description = $description;
        $this->price = $price;
    }
}