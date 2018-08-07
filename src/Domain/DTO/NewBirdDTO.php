<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\NewBirdDTOInterface;

class NewBirdDTO implements NewBirdDTOInterface
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $birthdate;

    /**
     * @var int
     */
    public $price;

    /**
     * @var string
     */
    public $description;

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
    ) {
        $this->name = $name;
        $this->birthdate = $birthdate;
        $this->price = $price;
        $this->description = $description;
    }
}