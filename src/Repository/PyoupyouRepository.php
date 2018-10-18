<?php

namespace App\Repository;

use App\Entity\Pyoupyou;
use App\Entity\User;
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

    /**
     * @param $_id
     * @return Pyoupyou[] Returns an array of Pyoupyou objects
     */
    public function findAllByUser($_id){
        return $this->createQueryBuilder('p')
            ->join('p.user','u')
            ->join('p.repostUsers','r')
            ->andWhere('u.id=:id OR r.id=:id')
            ->setParameter('id', $_id)
            ->orderBy('p.date')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $_user
     * @return Pyoupyou[] Returns an array of Pyoupyou objects
     */
    public function findUserFeed($_user){
        return $this->createQueryBuilder('p')
            ->join('p.user',  'u')
            ->join('u.followed',  'f', 'WITH', 'f.userFrom = :user')
            ->setParameter('user', $_user)
            ->getQuery()
            ->getResult();
    }
}
