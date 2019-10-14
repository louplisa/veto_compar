<?php

namespace App\Repository;

use App\Entity\VeterinaryClinic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VeterinaryClinic|null find($id, $lockMode = null, $lockVersion = null)
 * @method VeterinaryClinic|null findOneBy(array $criteria, array $orderBy = null)
 * @method VeterinaryClinic[]    findAll()
 * @method VeterinaryClinic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VeterinaryClinicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VeterinaryClinic::class);
    }

    // /**
    //  * @return VeterinaryClinic[] Returns an array of VeterinaryClinic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VeterinaryClinic
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
