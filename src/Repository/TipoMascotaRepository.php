<?php

namespace App\Repository;

use App\Entity\TipoMascota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoMascota|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoMascota|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoMascota[]    findAll()
 * @method TipoMascota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoMascotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoMascota::class);
    }

    // /**
    //  * @return TipoMascota[] Returns an array of TipoMascota objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoMascota
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
