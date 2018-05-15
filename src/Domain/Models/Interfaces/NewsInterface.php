<?php

declare(strict_types=1);

namespace App\Domain\Models\Interfaces;

interface NewsInterface
{
    public function getId();

    public function getContent();

    public function getTitle();

    public function getDateCreation();

    public function getImage();

    public function getAuthor();
}
