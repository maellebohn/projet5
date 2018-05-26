<?php

declare(strict_types=1);

namespace App\Domain\Models\Interfaces;

interface InfosInterface
{
    public function getId();

    public function getContent();

    public function getTitle();

    public function getDateCreation();

    public function getDateModification();

    public function getImage();

    public function getAuthor();

    public function getCategory();
}
