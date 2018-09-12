<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\UpdateBirdDTOInterface;

class UpdateBirdDTO implements UpdateBirdDTOInterface
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
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $price;

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
    ) {
        $this->name = $name;
        $this->birthdate = $birthdate;
        $this->price = $price;
        $this->description = $description;
    }
}