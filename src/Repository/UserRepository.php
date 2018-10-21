<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
    * @return User[] Returns an array of User objects
    */
    public function findAllPublic(): array
    {
       return $qb = $this->createQueryBuilder('u')
            ->andWhere('u.isPublic = 1')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $value
     * @return User[] Returns an array of User objects
     */
    public function findPublicByValue(string $value): array
    {
        return $qb = $this->createQueryBuilder('u')
            ->andWhere('u.isPublic = 1')
            ->where('u.username LIKE :value OR u.firstname LIKE :value OR u.lastname LIKE :value')
            ->setParameter('value', '%'.$value.'%')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $value
     * @return User[] Returns an array of User objects
     */
    public function findByValue(string $value)
    {
        return $qb = $this->createQueryBuilder('u')
            ->andWhere('u.username LIKE :value OR u.firstname LIKE :value OR u.lastname LIKE :value')
            ->setParameter('value', '%'.$value.'%')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $incub
     * @return User[] Returns an array of User objects
     */
    public function findAllByIncub($incub)
    {
        return $qb = $this->createQueryBuilder('u')
            ->join('u.project', 'p')
            ->where('p.incubator = :incub')
            ->setParameter('incub', $incub)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
