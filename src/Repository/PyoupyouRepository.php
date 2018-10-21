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
     * @param $user
     * @return Pyoupyou[] Returns an array of Pyoupyou objects
     */
    public function findAllByUser($user){
        return $this->createQueryBuilder('p')
            ->join('p.user','u')
            ->andWhere('u=:user')
            ->leftJoin('p.repostUsers','r')
            ->orWhere('r=:user')
            ->setParameter('user', $user)
            ->orderBy('p.date','DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $user
     * @return Pyoupyou[] Returns an array of Pyoupyou objects
     */
    public function findUserFeed($user){
        return $this->createQueryBuilder('p')
            ->join('p.user',  'u')
            ->leftjoin('u.followed','f')
            /*->leftjoin('p.repostUsers','r')
            ->leftjoin('r.followed','rf')
            ->leftjoin('p.Likes','l')
            ->leftjoin('l.followed','lf') // trop de temps d'execution */
            ->andWhere('f.userTo=:user')
            /*->orWhere('rf.userTo =:user')
            ->orWhere('lf.userTo =:user')*/
            ->setParameter('user', $user)
            ->orderBy('p.date', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
