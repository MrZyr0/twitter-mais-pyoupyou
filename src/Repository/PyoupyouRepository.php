<?php

namespace App\Repository;

use App\Entity\Pyoupyou;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pyoupyou|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pyoupyou|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pyoupyou[]    findAll()
 * @method Pyoupyou[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PyoupyouRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pyoupyou::class);
    }

//    /**
//     * @return Pyoupyou[] Returns an array of Pyoupyou objects
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
    public function findOneBySomeField($value): ?Pyoupyou
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
