<?php

namespace App\Repository;

use App\Entity\Lcommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Lcommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lcommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lcommande[]    findAll()
 * @method Lcommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LcommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lcommande::class);
    }

    // /**
    //  * @return Lcommande[] Returns an array of Lcommande objects
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
    public function findOneBySomeField($value): ?Lcommande
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
