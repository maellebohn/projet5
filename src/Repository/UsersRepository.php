<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\Users;
use App\Repository\Interfaces\UsersRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository implements UsersRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function save(UsersInterface $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function update()
    {
        $this->_em->flush();
    }

    /**
     * @param string $username
     * @param string $email
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getUserByUsernameAndEmail(string $username, string $email)
    {
        return $this->createQueryBuilder('users')
            ->where('users.username = :username AND users.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $token
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getUserByResetPasswordToken(string $token)
    {
        return $this->createQueryBuilder('users')
            ->where('users.resetPasswordToken = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
