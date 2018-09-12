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

    /**
     * @return UuidInterface
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool|\DateTime
     */
    public function getBirthdate()
    {
        return \DateTime::createFromFormat('U', (string) $this->birthdate);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return bool
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Birds constructor.
     *
     * @param string $name
     * @param int    $birthdate
     * @param string $description
     * @param int    $price
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

    /**
     * @param NewBirdDTO $newBirdDTO
     *
     * @return Birds
     */
    public function create(NewBirdDTO $newBirdDTO): self
    {
        $this->name = $newBirdDTO->name;
        $this->birthdate = $newBirdDTO->birthdate;
        $this->price = $newBirdDTO->price;
        $this->description = $newBirdDTO->description;
    }

    /**
     * @param UpdateBirdDTO $updateBirdDTO
     */
    public function update(UpdateBirdDTO $updateBirdDTO)
    {
        $this->name = $updateBirdDTO->name;
        $this->birthdate = $updateBirdDTO->birthdate;
        $this->description = $updateBirdDTO->description;
        $this->price = $updateBirdDTO->price;
    }

    public function reservation()
    {
        $this->reservation = true;
    }

    public function deleteReservation()
    {
        $this->reservation = false;
    }
}
