<?php

declare(strict_types=1);

namespace App\Domain\DTO\Interfaces;

use App\Domain\Models\Interfaces\UsersInterface;

interface NewInfoDTOInterface
{
    /**
     * NewInfoDTO constructor.
     *
     * @param string            $title
     * @param string            $category
     * @param string            $content
     * @param \SplFileInfo|null $image
     */
    public function __construct(
        string $title,
        string $category,
        string $content,
        \SplFileInfo $image = null
    );
}