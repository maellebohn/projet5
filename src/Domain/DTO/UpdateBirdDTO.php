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
     * @var string
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