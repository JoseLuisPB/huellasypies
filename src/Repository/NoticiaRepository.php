<?php

namespace App\Repository;

use App\Entity\Noticia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Noticia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Noticia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Noticia[]    findAll()
 * @method Noticia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoticiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Noticia::class);
    }

    // /**
    //  * @return Noticia[] Returns an array of Noticia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Noticia
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function noticias_usuario($usuario): array { 
        $entityManager = $this->getEntityManager();
        # Creación de la query con lenguaje DQL, IMPORTANTE usar los alias e indicar en el from el namespace 
        $query = $entityManager->createQuery('SELECT noticias FROM App\Entity\Noticia noticias WHERE noticias.autor = :usuario ');
        # Ajustamos el párametro de la query con el parámetro que le hemos pasado a la función 
        return $query->setParameter('usuario', $usuario)->getResult();
    }

    public function ultimas_noticias(): array { 
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT news FROM App\Entity\Noticia news ORDER BY news.id DESC ')->setMaxResults( 2 );
        return $query->getResult();
    }

    public function lista_noticias(): array { 
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT news FROM App\Entity\Noticia news WHERE news.estado = 2 ORDER BY news.id DESC ');
        return $query->getResult();
    }
}
