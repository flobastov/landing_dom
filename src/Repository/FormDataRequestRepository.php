<?php

namespace App\Repository;

use App\Entity\FormDataRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FormDataRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormDataRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormDataRequest[]    findAll()
 * @method FormDataRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormDataRequestRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FormDataRequest::class);
    }

    // /**
    //  * @return FormDataRequest[] Returns an array of FormDataRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormDataRequest
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
