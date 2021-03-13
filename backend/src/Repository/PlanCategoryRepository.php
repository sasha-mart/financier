<?php

namespace App\Repository;

use App\Entity\PlanCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
}
