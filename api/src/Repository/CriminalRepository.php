<?php

namespace App\Repository;

use App\Entity\Criminal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Criminal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Criminal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Criminal[]    findAll()
 * @method Criminal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CriminalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Criminal::class);
    }

    // /**
    //  * @return Criminal[] Returns an array of Criminal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Criminal
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
