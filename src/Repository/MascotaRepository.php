<?php

namespace App\Repository;

use App\Entity\Mascota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mascota|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mascota|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mascota[]    findAll()
 * @method Mascota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MascotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mascota::class);
    }

    // /**
    //  * @return Mascota[] Returns an array of Mascota objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mascota
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function mascotas_usuario($usuario): array { 
        $entityManager = $this->getEntityManager();
        # Creación de la query con lenguaje DQL, IMPORTANTE usar los alias e indicar en el from el namespace 
        $query = $entityManager->createQuery('SELECT mas.id, mas.nombre, est.estado, est.id AS id_estado FROM App\Entity\Mascota mas, App\Entity\EstadoMascota est WHERE est.id = mas.estado AND mas.usuario = :duenyo ');
        # Ajustamos el párametro de la query con el parámetro que le hemos pasado a la función 
        return $query->setParameter('duenyo', $usuario)->getResult();
    }
}
