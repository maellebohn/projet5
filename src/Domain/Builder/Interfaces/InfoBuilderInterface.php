<?php

declare(strict_types=1);

namespace App\Domain\Builder\Interfaces;

use App\Domain\Models\Infos;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface InfoBuilderInterface
{
    /**
     * @param string       $title
     * @param string       $author
     * @param UploadedFile $image
     * @param string       $content
     *
     * @return InfoBuilder
     */
    public function create(string $title, string $author, UploadedFile $image, string $content): self;

    public function getInfo(): Infos;
}