<?php

namespace App\Repository;

use App\Entity\Fornisseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Fornisseur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fornisseur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fornisseur[]    findAll()
 * @method Fornisseur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FornisseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fornisseur::class);
    }

    // /**
    //  * @return Fornisseur[] Returns an array of Fornisseur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fornisseur
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
