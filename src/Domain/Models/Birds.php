<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\BirdsInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Birds implements BirdsInterface
{
    /**
     * @var UuidInterface
     */
    private $id;

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
     * @var bool
     */
    private $reservation;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $name,
        string $birthdate,
        string $description,
        int $price
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->birthdate = $birthdate;
        $this->description = $description;
        $this->price = $price;
        $this->reservation = false;
    }
}
