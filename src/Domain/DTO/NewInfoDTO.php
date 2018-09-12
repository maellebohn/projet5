<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\NewInfoDTOInterface;

class NewInfoDTO implements NewInfoDTOInterface
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var \SplFileInfo|null
     */
    public $image = null;

    /**
     * @var string
     */
    public $category;

    /**
     * @var string
     */
    public $content;

    /**
     * NewInfoDTO constructor.
     *
     * @param string            $title
     * @param string            $category
     * @param string            $content
     * @param \SplFileInfo|null $image
     */
    public function __construct(
        string $title,
        string $category,
        string $content,
        \SplFileInfo $image = null
    ) {
        $this->title = $title;
        $this->category = $category;
        $this->content = $content;
        $this->image =  $image;
    }
}