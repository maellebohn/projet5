<?php

declare(strict_types=1);

namespace App\Domain\DTO\Interfaces;

interface NewNewsDTOInterface
{
    /**
     * NewNewsDTO constructor.
     *
     * @param string            $title
     * @param string            $content
     * @param \SplFileInfo|null $image
     */
    public function __construct(
        string $title,
        \SplFileInfo $image = null,
        string $content
    );
}