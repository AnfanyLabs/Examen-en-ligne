<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Utilisateur>
 */
class UtilisateurRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Utilisateur) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }


    /**
     * @return Utilisateur[] in waiting
     */

    public function findUserNotAuthorized(): array
    {
          return $this->createQueryBuilder('u')
              ->andWhere('u.statut = :statut')
                ->setParameter('statut', false)
               ->getQuery()
               ->getResult();
    }

    /**
     * @return Utilisateur[] authorized
     */

    public function findCandidatesAuthorized(): array
    {
          return $this->createQueryBuilder('u')
              ->where('u.statut = :statut')
              ->andWhere('u.roles LIKE  :role')
                ->setParameter('statut', true)
                ->setParameter('role', "%ROLE_CANDIDAT%")
               ->getQuery()
               ->getResult();
    }

    public function findEnseignantsAuthorized():array
    {
         return $this->createQueryBuilder('u')
              ->where('u.statut = :statut')
              ->andWhere('u.roles LIKE  :role')
                ->setParameter('statut', true)
                ->setParameter('role', "%ROLE_ENSEIGNANT%")
               ->getQuery()
               ->getResult();
    }


    //    /**
    //     * @return Utilisateur[] Returns an array of Utilisateur objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Utilisateur
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
