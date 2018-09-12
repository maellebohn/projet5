<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\NewNewsDTOInterface;

class NewNewsDTO implements NewNewsDTOInterface
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var \SplFileInfo|null
     */
    public $image;

    /**
     * @var string
     */
    public $content;

    /**
     * NewNewsDTO constructor.
     *
     * @param string            $title
     * @param string            $content
     * @param \SplFileInfo|null $image
     */
    public function __construct(
        string $title,
        \SplFileInfo $image = null,
        string $content
    ) {
        $this->title = $title;
        $this->image =  $image;
        $this->content = $content;
    }
}