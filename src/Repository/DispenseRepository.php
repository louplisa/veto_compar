<?php

namespace App\Repository;

use App\Entity\Dispense;
use App\Entity\DispenseSearch;
use App\Entity\VeterinaryClinicSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Dispense|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dispense|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dispense[]    findAll()
 * @method Dispense[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DispenseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dispense::class);
    }

    public function findPriceByTreatment(DispenseSearch $search): Query
    {
        $query = $this->findVisibleQuery();

        if ($search->getPet()) {
            $query = $query
                ->andWhere('d.pet = :pet')
                ->setParameter('pet', $search->getPet());
        }
        if ($search->getMedicalTreatment()) {
            $query = $query
                ->andWhere('d.medical_treatment = :medical_treatment')
                ->setParameter('medical_treatment', $search->getMedicalTreatment());
        }
        return $query->getQuery();
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('d');
    }

    // /**
    //  * @return Dispense[] Returns an array of Dispense objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dispense
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
