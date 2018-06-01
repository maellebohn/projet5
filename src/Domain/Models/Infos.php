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
     * @var string
     */
    private $dateCreation;

    /**
     * @var string
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

    /**
     * @var string
     */
    private $category;

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
//        return \DateTime::createFromFormat('U', (string) $this->dateCreation);
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

    public function getCategory()
    {
        return $this->category;
    }

    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $content,
        string $title,
        string $image,
        string $author,
        string $category
    ) {
        $this->id = Uuid::uuid4();
        $this->content = $content;
        $this->title = $title;
        $this->dateCreation = new \DateTime();
        $this->dateModification = null;
        $this->image = $image;
        $this->author = $author;
        $this->category = $category;
    }

    public function create(NewInfoDTO $newinfoDTO): self
    {
        $this->content = $newinfoDTO->content;
        $this->title = $newinfoDTO->title;
        $this->image = $newinfoDTO->image;
        $this->author = $newinfoDTO->author;
        $this->category = $newinfoDTO->category;
    }
}
