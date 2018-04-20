<?php

namespace App\Domain\Models;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use App\Domain\Models\Interfaces\InfosInterface;

class Infos implements InfosInterface
{
  /**
    * @var \Ramsey\Uuid\UuidInterface
  */
    private $id;
    private $content;
    private $title;
    private $dateCreation;
    private $dateModification;
    private $image;
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

    public function __construct(
        $content,
        $title,
        $image,
        $author
    ) {
        $this->id = Uuid::uuid4();
        $this->content = $content;
        $this->title = $title;
        $this->dateCreation = new DateTime('now');
        $this->dateModification = null;
        $this->image = $image;
        $this->author = $author;
    }
}
