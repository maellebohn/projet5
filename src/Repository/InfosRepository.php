<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Models\Interfaces\InfosInterface;
use App\Domain\Models\Infos;
use App\Repository\Interfaces\InfosRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Infos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Infos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Infos[]    findAll()
 * @method Infos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfosRepository extends ServiceEntityRepository implements InfosRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Infos::class);
    }

    /**
     * @param InfosInterface $info
     */
    public function save(InfosInterface $info)
    {
        $this->_em->persist($info);
        $this->_em->flush();
    }

    public function remove(InfosInterface $info)
    {
        $this->_em->remove($info);
        $this->_em->flush();
    }
}
