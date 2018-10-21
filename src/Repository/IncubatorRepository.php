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

    /**
     * @return Incubator[] Returns an array of Incubator objects
     */
    public function findAllPublic(): array
    {
        $qb = $this->createQueryBuilder('i')
            ->andWhere('i.isPublic = 1')
            ->getQuery();
        return $qb->execute();
    }

    /**
     * @param $value
     * @return Incubator[] Returns an array of Incubator objects
     */
    public function findPublicByValue(string $value): array
    {
        $qb = $this->createQueryBuilder('i')
            ->andWhere('i.isPublic = 1')
            ->where('i.name LIKE :value')
            ->setParameter('value', '%'.$value.'%')
            ->getQuery();
        return $qb->execute();
    }

    /**
     * @param $value
     * @return Incubator[] Returns an array of Incubator objects
     */
    public function findByValue(string $value)
    {
        $qb = $this->createQueryBuilder('i')
            ->andWhere('i.name LIKE :value')
            ->setParameter('value', '%'.$value.'%')
            ->getQuery();
        return $qb->execute();
    }

}
