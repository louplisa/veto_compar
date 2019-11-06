<?php

namespace App\Repository;

use App\Entity\VeterinaryClinic;
use App\Entity\VeterinaryClinicSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VeterinaryClinic|null find($id, $lockMode = null, $lockVersion = null)
 * @method VeterinaryClinic|null findOneBy(array $criteria, array $orderBy = null)
 * @method VeterinaryClinic[]    findAll()
 * @method VeterinaryClinic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VeterinaryClinicRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VeterinaryClinic::class);
    }

    /**
     * @param VeterinaryClinicSearch $search
     * @return Query
     */
    public function findAllVisibleQuery(VeterinaryClinicSearch $search): Query
    {
        $query = $this->findVisibleQuery();

        if ($search->getZipCode()) {
            $query = $query
                ->andWhere('v.zip_code = :zipCode')
                ->setParameter('zipCode', $search->getZipCode());
        }
        if ($search->getCity()) {
            $query = $query
                ->andWhere('v.city = :city')
                ->setParameter('city', $search->getCity());
        }



        return $query->getQuery();

    }

    private function  findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('v');

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
