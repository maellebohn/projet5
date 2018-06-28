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
     * @var string
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