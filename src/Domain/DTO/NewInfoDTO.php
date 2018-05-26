<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class NewInfoDTO
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $author;

    /**
     * @var UploadedFile
     */
    public $image;

    /**
     * @var string
     */
    public $category;

    /**
     * @var string
     */
    public $content;

    public function __construct(
        string $title,
        string $author,
        UploadedFile $image,
        string $category,
        string $content
    ) {
        $this->title = $title;
        $this-> author = $author;
        $this->image =  $image;
        $this->category = $category;
        $this->content = $content;
    }
}