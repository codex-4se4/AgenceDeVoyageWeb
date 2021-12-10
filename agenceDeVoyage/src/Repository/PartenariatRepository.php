<?php

namespace App\Repository;

use App\Entity\Partenariat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Partenariat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partenariat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partenariat[]    findAll()
 * @method Partenariat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartenariatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partenariat::class);
    }

    // /**
    //  * @return Partenariat[] Returns an array of Partenariat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Partenariat
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
