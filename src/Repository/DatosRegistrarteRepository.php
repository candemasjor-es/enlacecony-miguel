<?php

namespace App\Repository;

use App\Entity\DatosRegistrarte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DatosRegistrarte>
 *
 * @method DatosRegistrarte|null find($id, $lockMode = null, $lockVersion = null)
 * @method DatosRegistrarte|null findOneBy(array $criteria, array $orderBy = null)
 * @method DatosRegistrarte[]    findAll()
 * @method DatosRegistrarte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DatosRegistrarteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DatosRegistrarte::class);
    }

    public function findByUsuario($usuario)
    {
        return $this->createQueryBuilder('u')
            ->where('u.Usuario = :usuario')
            ->setParameter('usuario', $usuario)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function countAllDatosRegistrarte()
    {
    return $this->createQueryBuilder('dr')
        ->select('count(dr.id)')
        ->getQuery()
        ->getSingleScalarResult();
    }   
    //    /**
    //     * @return DatosRegistrarte[] Returns an array of DatosRegistrarte objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DatosRegistrarte
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
