<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\DTO\NewInfoDTO;
use App\Domain\DTO\UpdateInfoDTO;
use App\Domain\Models\Interfaces\InfosInterface;
use App\Domain\Models\Interfaces\UsersInterface;
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
     * @var string|null
     */
    private $image = null;

    /**
     * @var UsersInterface
     */
    private $author;

    /**
     * @var string
     */
    private $category;

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

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Infos constructor.
     *
     * @param string         $content
     * @param string         $title
     * @param UsersInterface $author
     * @param string         $category
     * @param string|null    $image
     *
     * @throws \Exception
     */
    public function __construct(
        string $content,
        string $title,
        UsersInterface $author,
        string $category,
        string $image = null
    ) {
        $this->id = Uuid::uuid4();
        $this->content = $content;
        $this->title = $title;
        $this->dateCreation = time();
        $this->author = $author;
        $this->category = $category;
        $this->image = $image;
    }

    /**
     * @param NewInfoDTO $newInfoDTO
     *
     * @return Infos
     */
    public function create(NewInfoDTO $newInfoDTO): self
    {
        $this->content = $newInfoDTO->content;
        $this->title = $newInfoDTO->title;
        $this->image = $newInfoDTO->image;
        $this->category = $newInfoDTO->category;
    }

    /**
     * @param UpdateInfoDTO $updateInfoDTO
     */
    public function update(UpdateInfoDTO $updateInfoDTO)
    {
        $this->content = $updateInfoDTO->content;
        $this->title = $updateInfoDTO->title;
        $this->image = $updateInfoDTO->image;
        $this->category = $updateInfoDTO->category;
    }
}
