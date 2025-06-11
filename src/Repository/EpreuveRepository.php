<?php

namespace App\Repository;

use App\Entity\Epreuve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Epreuve>
 */
class EpreuveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Epreuve::class);
    }

    //    /**
    //     * @return Epreuve[] Returns an array of Epreuve objects
    //     */
        public function findByEpreuveByUser($value): array
        {
           return $this->createQueryBuilder('e')
               ->andWhere('e.utilisateur = :utilisateur')
                ->setParameter('utilisateur', $value)
                ->orderBy('e.id', 'ASC')
                ->getQuery()
                ->getResult()
            ;
        }


        public function epreuveForCandidat($classe): array
        {
           return $this->createQueryBuilder('e')
               ->andWhere('e.classe = :classe')
               ->andWhere('e.isPublished = :isPublished')
                ->setParameter('classe', $classe)
                ->setParameter('isPublished', true)
                ->orderBy('e.id', 'DESC')
                ->getQuery()
                ->getResult()
            ;
        }

    //    public function findOneBySomeField($value): ?Epreuve
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
