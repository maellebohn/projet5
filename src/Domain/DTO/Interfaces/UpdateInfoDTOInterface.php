<?php

declare(strict_types=1);

namespace App\Domain\DTO\Interfaces;

interface UpdateInfoDTOInterface
{
    /**
     * UpdateInfoDTO constructor.
     *
     * @param string      $title
     * @param string|null $image
     * @param string      $category
     * @param string      $content
     */
    public function __construct(
        string $title,
        string $image = null,
        string $category,
        string $content
    );
}