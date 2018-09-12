<?php

declare(strict_types=1);

namespace App\Domain\DTO\Interfaces;

use App\Domain\Models\Interfaces\UsersInterface;

interface UpdateNewsDTOInterface
{
    /**
     * UpdateNewsDTO constructor.
     *
     * @param string      $title
     * @param string|null $image
     * @param string      $content
     */
    public function __construct(
        string $title,
        string $image = null,
        string $content
    );
}