<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Project::class);
    }

    /**
     * @return Project[] Returns an array of Project objects
     */
    public function findAllPublic(): array
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.isPublic = 1')
            ->getQuery();
        return $qb->execute();
    }

    /**
     * @param $_value
     * @return Project[] Returns an array of Project objects
     */
    public function findPublicByValue(string $_value): array
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.isPublic = 1')
            ->where('p.name LIKE :value')
            ->setParameter('value', '%'.$_value.'%')
            ->getQuery();
        return $qb->execute();
    }

    /**
     * @param $_value
     * @return Project[] Returns an array of Project objects
     */
    public function findByValue(string $_value)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :value')
            ->setParameter('value', '%'.$_value.'%')
            ->getQuery();
        return $qb->execute();
    }

    /*
    public function findOneBySomeField($value): ?Project
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
