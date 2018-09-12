<?php

declare(strict_types=1);

namespace App\Helper\Interfaces;

interface FileUploaderHelperInterface
{
    /**
     * FileUploaderHelper constructor.
     *
     * @param string $imageFolder
     */
    public function __construct(string $imageFolder);

    /**
     * @return string
     */
    public function getImageFolder(): string;

    /**
     * @param \SplFileInfo $image
     *
     * @return string
     */
    public function upload(\SplFileInfo $image);
}