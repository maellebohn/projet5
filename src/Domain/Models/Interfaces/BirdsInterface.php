<?php

declare(strict_types=1);

namespace App\Domain\Models\Interfaces;

use App\Domain\DTO\NewBirdDTO;

interface BirdsInterface
{
    public function getId();

    public function getName();

    public function getBirthdate();

    public function getDescription();

    public function getPrice();

    public function getReservation();

    //public function create(NewBirdDTO $newBirdDTO): self;

    //public function update(UpdateBirdDTO $updateBirdDTO);
}
