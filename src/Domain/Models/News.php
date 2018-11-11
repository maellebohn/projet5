<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\DTO\NewNewsDTO;
use App\Domain\DTO\UpdateNewsDTO;
use App\Domain\Models\Interfaces\NewsInterface;
use App\Domain\Models\Interfaces\UsersInterface;
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
     * @var string|null
     */
    private $image = null;

    /**
     * @var UsersInterface
     */
    private $author;

    /**
     * @return UuidInterface
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return bool|DateTime
     */
    public function getDateCreation()
    {
        return \DateTime::createFromFormat('U', (string) $this->dateCreation);
    }

    /**
     * @return null|string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    public function __construct(
        string $content,
        string $title,
        UsersInterface $author,
        string $image = null
    ) {
        $this->id = Uuid::uuid4();
        $this->content = $content;
        $this->title = $title;
        $this->dateCreation = time();
        $this->author = $author;
        $this->image = $image;
    }

    /**
     * @param NewNewsDTO $newNewsDTO
     *
     * @return News
     */
    public function create(NewNewsDTO $newNewsDTO): self
    {
        $this->content = $newNewsDTO->content;
        $this->title = $newNewsDTO->title;
        $this->image = $newNewsDTO->image;
    }

    /**
     * @param UpdateNewsDTO $updateNewsDTO
     */
    public function update(UpdateNewsDTO $updateNewsDTO)
    {
        $this->content = $updateNewsDTO->content;
        $this->title = $updateNewsDTO->title;
        $this->image = $updateNewsDTO->image;
    }
}
