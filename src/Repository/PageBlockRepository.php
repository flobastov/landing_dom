<?php

namespace App\Repository;

use App\Entity\PageBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PageBlock|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageBlock|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageBlock[]    findAll()
 * @method PageBlock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageBlockRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PageBlock::class);
    }

    public function findByPage()
    {
        $result = [];
        $blocks = $this->findAll();

        foreach ($blocks as $block) {
            $result[$block->getCode()] = $block;
        }

        return $result;
    }

//    /**
//     * @return PageBlock[] Returns an array of PageBlock objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PageBlock
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
