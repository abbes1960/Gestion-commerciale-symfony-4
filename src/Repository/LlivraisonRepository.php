<?php

namespace App\Repository;

use App\Entity\Llivraison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Llivraison|null find($id, $lockMode = null, $lockVersion = null)
 * @method Llivraison|null findOneBy(array $criteria, array $orderBy = null)
 * @method Llivraison[]    findAll()
 * @method Llivraison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LlivraisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Llivraison::class);
    }

    // /**
    //  * @return Llivraison[] Returns an array of Llivraison objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Llivraison
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
