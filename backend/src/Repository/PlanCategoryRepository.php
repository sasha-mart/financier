<?php

namespace App\Repository;

use App\Entity\PlanCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PlanCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanCategory[]    findAll()
 * @method PlanCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanCategory::class);
    }

    // /**
    //  * @return PlanCategory[] Returns an array of PlanCategory objects
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
    public function findOneBySomeField($value): ?PlanCategory
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
