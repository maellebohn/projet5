<?php

declare(strict_types=1);

namespace App\Repository\Interfaces;

use App\Domain\Models\Interfaces\InfosInterface;

interface InfosRepositoryInterface
{
    public function findAll();

    public function save(InfosInterface $info);

    public function remove(InfosInterface $info);

    public function findBy(
        array $criteria,
        array $orderBy = null,
        $limit = null,
        $offset = null
    );

    public function findOneBy(
        array $criteria,
        array $orderBy = null
    );
}