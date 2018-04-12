<?php

namespace App\Entity;

class Users
{
  /**
    * @var \Ramsey\Uuid\UuidInterface
  */
    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $email;
    private $password;
    private $role;
    private $dateCreation;
    private $active;

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function getActive()
    {
        return $this->active;
    }
}
