<?php

namespace App\Repository;

use App\Entity\EstadoNoticia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadoNoticia|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoNoticia|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoNoticia[]    findAll()
 * @method EstadoNoticia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoNoticiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoNoticia::class);
    }

    // /**
    //  * @return EstadoNoticia[] Returns an array of EstadoNoticia objects
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
    public function findOneBySomeField($value): ?EstadoNoticia
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
