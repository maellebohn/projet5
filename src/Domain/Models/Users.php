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

    /**
     * @var int
     */
    private $askResetPasswordDate;

    /**
     * @var int
     */
    private $resetPasswordDate;

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
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return bool|\DateTime
     */
    public function getDateCreation()
    {
        return \DateTime::createFromFormat('U', (string) $this->dateCreation);
    }

    /**
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @return null|string
     */
    public function getResetPasswordToken()
    {
        return $this->resetPasswordToken;
    }

    /**
     * @return bool|\DateTime
     */
    public function getAskResetPasswordDate()
    {
        return \DateTime::createFromFormat('U', (string) $this->askResetPasswordDate);
    }

    /**
     * @return bool|\DateTime
     */
    public function getResetPasswordDate()
    {
        return \DateTime::createFromFormat('U', (string) $this->resetPasswordDate);
    }

    /**
     * @return null|string
     */
    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    /**
     * Users constructor.
     *
     * @param string   $firstname
     * @param string   $lastname
     * @param string   $username
     * @param string   $email
     * @param string   $password
     * @param callable $passwordEncoder
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

    /**
     * @param UserRegistrationDTO $userRegistrationDTO
     *
     * @return Users
     */
    public function create(UserRegistrationDTO $userRegistrationDTO): self
    {
        $this->firstname = $userRegistrationDTO->firstname;
        $this->lastname = $userRegistrationDTO->lastname;
        $this->username = $userRegistrationDTO->username;
        $this->email = $userRegistrationDTO->email;
        $this->password = $userRegistrationDTO->password;
    }

    /**
     * @param $resetPasswordToken
     */
    public function askForPasswordReset($resetPasswordToken)
    {
        $this->resetPasswordToken = $resetPasswordToken;
        $this->askResetPasswordDate = time();
    }

    /**
     * @param string $newPassword
     */
    public function updatePassword(string $newPassword): void
    {
        $this->password = $newPassword;
        $this->resetPasswordToken = null;
        $this->resetPasswordDate = null;
    }

    public function resetPasswordDate()
    {
        $this->resetPasswordDate = time();
    }

    public function updateAskResetPasswordDate()
    {
        $this->askResetPasswordDate = time();
    }
}
