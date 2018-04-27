<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\NewsInterface;
use DateTime;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class News implements NewsInterface
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $dateCreation;

    /**
     * @var int
     */
    private $image;

    /**
     * @var string
     */
    private $author;

    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function __construct(
        string $content,
        string $title,
        int $image,
        string $author
    ) {
        $this->id = Uuid::uuid4();
        $this->content = $content;
        $this->title = $title;
        $this->dateCreation = time();
        $this->image = $image;
        $this->author = $author;
    }
}
