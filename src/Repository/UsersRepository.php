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
}
