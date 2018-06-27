<?php

declare(strict_types=1);

namespace App\Domain\DTO;

class NewBirdDTO
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
     * @var int
     */
    private $price;

    /**
     * @var string
     */
    private $description;

    /**
     * NewBirdDTO constructor.
     *
     * @param string $name
     * @param string $birthdate
     * @param int    $price
     * @param string $description

     */
    public function __construct(
        string $name,
        string $birthdate,
        int $price,
        string $description
    ) {
        $this->name = $name;
        $this->birthdate = $birthdate;
        $this->price = $price;
        $this->description = $description;
    }
}