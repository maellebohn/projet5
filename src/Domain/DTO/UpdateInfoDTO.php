<?php

declare(strict_types=1);

namespace App\Domain\DTO;

use App\Domain\DTO\Interfaces\UpdateInfoDTOInterface;
use App\Domain\Models\Interfaces\UsersInterface;

class UpdateInfoDTO implements UpdateInfoDTOInterface
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
    public $category;

    /**
     * @var string
     */
    public $content;

    /**
     * UpdateInfoDTO constructor.
     *
     * @param string      $title
     * @param string|null $image
     * @param string      $category
     * @param string      $content
     */
    public function __construct(
        string $title,
        string $image = null,
        string $category,
        string $content
    ) {
        $this->title = $title;
        $this->image =  $image;
        $this->category = $category;
        $this->content = $content;
    }
}