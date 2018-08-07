<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Models\Birds;
use App\Domain\Models\Interfaces\BirdsInterface;
use App\Repository\Interfaces\BirdsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Birds|null find($id, $lockMode = null, $lockVersion = null)
 * @method Birds|null findOneBy(array $criteria, array $orderBy = null)
 * @method Birds[]    findAll()
 * @method Birds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BirdsRepository extends ServiceEntityRepository implements BirdsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Birds::class);
    }

    public function save(BirdsInterface $bird)
    {
        $this->_em->persist($bird);
        $this->_em->flush();
    }

    public function remove(BirdsInterface $bird)
    {
        $this->_em->remove($bird);
        $this->_em->flush();
    }

    public function update()
    {
        $this->_em->flush();
    }

    /**
     * @param string $id
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteById(string $id)
    {
        $bird = $this->createQueryBuilder('birds')
            ->where('birds.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        $this->_em->remove($bird);
        $this->_em->flush();
    }
}
