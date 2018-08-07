<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use App\Domain\Models\Interfaces\NewsInterface;

interface NewsRepositoryInterface
{
    public function findAll();

    public function save(NewsInterface $news);

    public function remove(NewsInterface $news);

    public function findOneBy(
        array $criteria,
        array $orderBy = null
    );

    public function deleteById(string $id);

    public function update();
}