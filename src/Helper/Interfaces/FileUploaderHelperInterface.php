<?php

declare(strict_types=1);

namespace App\Helper\Interfaces;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploaderHelperInterface
{
    public function __construct(string $imageFolder);

    public function getImageFolder(): string;

    public function upload(UploadedFile $image);
}