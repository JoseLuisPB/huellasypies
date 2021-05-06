<?php

namespace App\Repository;

use App\Entity\EstadoMascota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadoMascota|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoMascota|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoMascota[]    findAll()
 * @method EstadoMascota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoMascotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoMascota::class);
    }

    // /**
    //  * @return EstadoMascota[] Returns an array of EstadoMascota objects
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
    public function findOneBySomeField($value): ?EstadoMascota
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
