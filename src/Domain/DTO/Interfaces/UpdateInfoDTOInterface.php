<?php

declare(strict_types=1);

namespace App\Event\Interfaces;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UpdateInfoDTOInterface
{
    /**
     * NewInfoDTO constructor.
     *
     * @param string       $title
     * @param string       $author
     * @param UploadedFile $image
     * @param string       $category
     * @param string       $content
     */
    public function __construct(
        string $title,
        string $author,
        UploadedFile $image,
        string $category,
        string $content
    );
}