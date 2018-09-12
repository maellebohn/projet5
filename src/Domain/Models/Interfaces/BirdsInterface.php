<?php

declare(strict_types=1);

namespace App\Domain\Models\Interfaces;

use App\Domain\DTO\NewBirdDTO;
use App\Domain\DTO\UpdateBirdDTO;

interface BirdsInterface
{
    public function getId();

    public function getName();

    public function getBirthdate();

    public function getDescription();

    public function getPrice();

    public function getReservation();

    public function update(UpdateBirdDTO $updateBirdDTO);

    public function reservation();

    public function deleteReservation();
}
