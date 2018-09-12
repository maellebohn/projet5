<?php

declare(strict_types=1);

namespace App\Domain\Models\Interfaces;

use App\Domain\DTO\NewNewsDTO;
use App\Domain\DTO\UpdateNewsDTO;

interface NewsInterface
{
    public function getId();

    public function getContent();

    public function getTitle();

    public function getDateCreation();

    public function getImage();

    public function getAuthor();

    public function update(UpdateNewsDTO $updateNewsDTO);
}
