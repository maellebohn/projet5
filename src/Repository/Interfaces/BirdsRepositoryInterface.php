<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use App\Domain\Models\Interfaces\BirdsInterface;

interface BirdsRepositoryInterface
{
    public function findAll();

    public function save(BirdsInterface $bird);

    public function remove(BirdsInterface $bird);

    public function findOneBy(
        array $criteria,
        array $orderBy = null
    );

}