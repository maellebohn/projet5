<?php

declare(strict_types=1);

namespace App\Domain\DTO;

class UpdateNewsDTO
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
     * @var string
     */
    public $image;

    /**
     * @var string
     */
    public $content;

    /**
     * UpdateNewsDTO constructor.
     *
     * @param string $title
     * @param string $author
     * @param string $image
     * @param string $content
     */
    public function __construct(
        string $title,
        string $author,
        string $image,
        string $content
    ) {
        $this->title = $title;
        $this-> author = $author;
        $this->image =  $image;
        $this->content = $content;
    }
}