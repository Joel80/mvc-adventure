<?php

namespace App\Repository;

use App\Entity\EventDescriptor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EventDescriptor|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventDescriptor|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventDescriptor[]    findAll()
 * @method EventDescriptor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventDescriptorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventDescriptor::class);
    }

    // /**
    //  * @return EventDescriptor[] Returns an array of EventDescriptor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventDescriptor
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
