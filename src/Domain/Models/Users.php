<?php

namespace App\Domain\Models;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use App\Domain\Models\Interfaces\UsersInterface;

class Users implements UsersInterface
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

    public function __construct(
        $firstname,
        $lastname,
        $username,
        $email,
        $password,
        $role
    ) {
        $this->id = Uuid::uuid4();
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->dateCreation = new DateTime('now');
        $this->role = $role;
        $active->active = true;
    }
}
