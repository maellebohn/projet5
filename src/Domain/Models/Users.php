<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\DTO\UserRegistrationDTO;
use App\Domain\Models\Interfaces\UsersInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Users implements UsersInterface, UserInterface
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var int
     */
    private $dateCreation;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var string
     */
    private $resetPasswordToken;

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

    public function getRoles()
    {
        return $this->roles;
    }

    public function getDateCreation()
    {
        return \DateTime::createFromFormat('U', (string) $this->dateCreation);
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getResetPasswordToken()
    {
        return $this->resetPasswordToken;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function __construct(
        string $firstname,
        string $lastname,
        string $username,
        string $email,
        string $password,
        callable $passwordEncoder
    ) {
        $this->id = Uuid::uuid4();
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $passwordEncoder($password, null);
        $this->dateCreation = time();
        $this->roles = ['ROLE_ADMIN'];
        $this->active = true;
        $this->resetPasswordToken = null;
    }

    public function create(UserRegistrationDTO $userRegistrationDTO): self
    {
        $this->firstname = $userRegistrationDTO->firstname;
        $this->lastname = $userRegistrationDTO->lastname;
        $this->username = $userRegistrationDTO->username;
        $this->email = $userRegistrationDTO->email;
        $this->password = $userRegistrationDTO->password;
    }

    public function askForPasswordReset($resetPasswordToken)
    {
        $this->resetPasswordToken = $resetPasswordToken->getResetPasswordToken();
    }
}
