<?php

namespace App\Entity;

class Birds
{
/**
  * @var \Ramsey\Uuid\UuidInterface
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
