<?php

namespace App\Repository;

use App\Entity\ItemDescriptor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItemDescriptor|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemDescriptor|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemDescriptor[]    findAll()
 * @method ItemDescriptor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemDescriptorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemDescriptor::class);
    }

    // /**
    //  * @return ItemDescriptor[] Returns an array of ItemDescriptor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ItemDescriptor
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
