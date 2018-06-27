<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Models\Interfaces\NewsInterface;
use App\Domain\Models\News;
use App\Repository\Interfaces\NewsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository implements NewsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    public function save(NewsInterface $news)
    {
        $this->_em->persist($news);
        $this->_em->flush();
    }

    public function remove(NewsInterface $news)
    {
        $this->_em->remove($news);
        $this->_em->flush();
    }

    public function update()
    {
        $this->_em->flush();
    }
}
