<?php

namespace App\Repository;

use App\Entity\Incubator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Incubator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Incubator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Incubator[]    findAll()
 * @method Incubator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncubatorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Incubator::class);
    }

//    /**
//     * @return Incubator[] Returns an array of Incubator objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Incubator
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
