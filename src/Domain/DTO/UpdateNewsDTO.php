<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\UpdateNewsDTOInterface;
use App\Domain\Models\Interfaces\UsersInterface;

class UpdateNewsDTO implements UpdateNewsDTOInterface
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string|null
     */
    public $image;

    /**
     * @var string
     */
    public $content;

    /**
     * UpdateNewsDTO constructor.
     *
     * @param string      $title
     * @param string|null $image
     * @param string      $content
     */
    public function __construct(
        string $title,
        string $image = null,
        string $content
    ) {
        $this->title = $title;
        $this->image =  $image;
        $this->content = $content;
    }
}