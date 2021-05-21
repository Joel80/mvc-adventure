<?php

namespace App\Repository;

use App\Entity\ExitDescriptor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExitDescriptor|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExitDescriptor|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExitDescriptor[]    findAll()
 * @method ExitDescriptor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExitDescriptorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExitDescriptor::class);
    }

    // /**
    //  * @return ExitDescriptor[] Returns an array of ExitDescriptor objects
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
    public function findOneBySomeField($value): ?ExitDescriptor
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
