<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\DTO\NewBirdDTO;
use App\Domain\DTO\UpdateBirdDTO;
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
     * @var int
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
        return \DateTime::createFromFormat('U', (string) $this->birthdate);
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
        int $birthdate,
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

    public function create(NewBirdDTO $newBirdDTO): self
    {
        $this->name = $newBirdDTO->name;
        $this->birthdate = $newBirdDTO->birthdate;
        $this->price = $newBirdDTO->price;
        $this->description = $newBirdDTO->description;
    }

    public function update(UpdateBirdDTO $updateBirdDTO)
    {
        $this->name = $updateBirdDTO->name;
        $this->birthdate = $updateBirdDTO->birthdate;
        $this->description = $updateBirdDTO->description;
        $this->price = $updateBirdDTO->price;
    }
}
