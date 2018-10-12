<?php

namespace App\Repository;

use App\Entity\PyouPyou;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PyouPyou|null find($id, $lockMode = null, $lockVersion = null)
 * @method PyouPyou|null findOneBy(array $criteria, array $orderBy = null)
 * @method PyouPyou[]    findAll()
 * @method PyouPyou[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PyouPyouRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PyouPyou::class);
    }

//    /**
//     * @return PyouPyou[] Returns an array of PyouPyou objects
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
    public function findOneBySomeField($value): ?PyouPyou
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
