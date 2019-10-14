<?php

namespace App\Repository;

use App\Entity\MedicalTreatment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MedicalTreatment|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicalTreatment|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicalTreatment[]    findAll()
 * @method MedicalTreatment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicalTreatmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MedicalTreatment::class);
    }

    // /**
    //  * @return MedicalTreatment[] Returns an array of MedicalTreatment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MedicalTreatment
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
