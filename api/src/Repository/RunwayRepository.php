<?php

namespace App\Repository;

use App\Entity\Runway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Runway|null find($id, $lockMode = null, $lockVersion = null)
 * @method Runway|null findOneBy(array $criteria, array $orderBy = null)
 * @method Runway[]    findAll()
 * @method Runway[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RunwayRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Runway::class);
    }

    // /**
    //  * @return Runway[] Returns an array of Runway objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Runway
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
