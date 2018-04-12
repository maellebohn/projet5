<?php

namespace App\Entity;

class News
{
  /**
    * @var \Ramsey\Uuid\UuidInterface
  */
    private $id;
    private $content;
    private $title;
    private $dateCreation;
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

    public function getImage()
    {
        return $this->image;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}
