<?php

namespace App\Repository;

use App\Entity\ElegirMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ElegirMenu>
 *
 * @method ElegirMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElegirMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElegirMenu[]    findAll()
 * @method ElegirMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElegirMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElegirMenu::class);
    }

//    /**
//     * @return ElegirMenu[] Returns an array of ElegirMenu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ElegirMenu
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
