<?php

namespace App\Repository;

use App\Entity\PersonasPequenos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PersonasPequenos>
 *
 * @method PersonasPequenos|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonasPequenos|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonasPequenos[]    findAll()
 * @method PersonasPequenos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonasPequenosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonasPequenos::class);
    }

    public function countAllPersonasPequenos()
    {
        return $this->createQueryBuilder('personas_pequenos')
            ->select('count(personas_pequenos.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    //    /**
    //     * @return PersonasPequenos[] Returns an array of PersonasPequenos objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PersonasPequenos
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
