<?php

namespace App\Domain\Models;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use App\Domain\Models\Interfaces\BirdsInterface;

class Birds implements BirdsInterface
{
/**
  * @var UuidInterface
*/
    private $id;
    private $name;
    private $birthdate;
    private $description;
    private $price;
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

    public function __construct(
        $name,
        $birthdate,
        $description,
        $price
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->birthdate = $birthdate;
        $this->description = $description;
        $this->price = $price;
        $this->reservation = false;
    }

    public function getBird()
    {
      return $this->name;
      return $this->birthdate;
      return $this->description;
      return $this->price;
    }
}
