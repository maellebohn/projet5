<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\DTO\NewInfoDTO;
use App\Domain\Models\Interfaces\InfosInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Infos implements InfosInterface
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
    private $dateModification;

    /**
     * @var string
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

    public function getDateModification()
    {
        return $this->dateModification;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $content,
        string $title,
        string $image,
        string $author
    ) {
        $this->id = Uuid::uuid4();
        $this->content = $content;
        $this->title = $title;
        $this->dateCreation = time();
        $this->dateModification = null;
        $this->image = $image;
        $this->author = $author;
    }

    public function create(NewInfoDTO $newinfoDTO): self
    {
        $this->content = $newinfoDTO->content;
        $this->title = $newinfoDTO->title;
        $this->image = $newinfoDTO->image;
        $this->author = $newinfoDTO->author;

        return $this;
    }

    public function getInfos(): Infos
    {
        return $this->infos;
    }
}
