<?php

declare(strict_types=1);

namespace App\Domain\DTO;

class UpdateInfoDTO
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
    public $category;

    /**
     * @var string
     */
    public $content;

    /**
     * UpdateInfoDTO constructor.
     *
     * @param string $title
     * @param string $author
     * @param string $image
     * @param string $category
     * @param string $content
     */
    public function __construct(
        string $title,
        string $author,
        string $image,
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