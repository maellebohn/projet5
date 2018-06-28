<?php

declare(strict_types=1);

namespace App\Domain\DTO\Interfaces;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface NewNewsDTOInterface
{
    /**
     * NewNewsDTO constructor.
     *
     * @param string       $title
     * @param string       $author
     * @param UploadedFile $image
     * @param string       $content
     */
    public function __construct(
        string $title,
        string $author,
        UploadedFile $image,
        string $content
    );
}