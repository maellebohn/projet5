<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InfosRepository")
 */
class Infos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    private $content;
    private $title;
    private $date_creation;
    private $date_modification;
    private $image;
    private $author_FK;

    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content=$content;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title=$title;
    }

    public function getDate_creation()
    {
        return $this->date_creation;
    }

    public function setDate_creation($date_creation)
    {
        $this->date_creation=$date_creation;
    }

    public function getDate_modification()
    {
        return $this->date_modification;
    }

    public function setDate_modification($date_modification)
    {
        $this->date_modification=$date_modification;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image=$image;
    }

    public function getAuthor_FK()
    {
        return $this->author_FK;
    }

    public function setAuthor_FK($author_FK)
    {
        $this->author_FK=$author_FK;
    }
}
