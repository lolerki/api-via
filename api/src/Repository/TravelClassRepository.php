<?php

namespace App\Repository;

use App\Entity\TravelClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TravelClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method TravelClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method TravelClass[]    findAll()
 * @method TravelClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TravelClassRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TravelClass::class);
    }

    // /**
    //  * @return TravelClass[] Returns an array of TravelClass objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TravelClass
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
