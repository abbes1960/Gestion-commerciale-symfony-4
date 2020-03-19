<?php

namespace App\Repository;

use App\Entity\Reglement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Reglement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reglement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reglement[]    findAll()
 * @method Reglement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReglementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reglement::class);
    }

    // /**
    //  * @return Reglement[] Returns an array of Reglement objects
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
    public function findOneBySomeField($value): ?Reglement
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
