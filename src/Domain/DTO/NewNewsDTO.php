<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\NewNewsDTOInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class NewNewsDTO implements NewNewsDTOInterface
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
    public $content;

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
    ) {
        $this->title = $title;
        $this-> author = $author;
        $this->image =  $image;
        $this->content = $content;
    }
}