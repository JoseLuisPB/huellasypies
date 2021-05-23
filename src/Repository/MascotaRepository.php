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

    public function ultimas_mascotas(): array { 
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT pet FROM App\Entity\Mascota pet WHERE pet.estado IN (1,2,3) AND pet.aprobada = true ORDER BY pet.id DESC ')->setMaxResults( 3 );
        return $query->getResult();
    }

    public function mascotas_disponibles_antiguas(): array{
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT pet FROM App\Entity\Mascota pet WHERE pet.estado IN (1,2,3) AND pet.aprobada = true ORDER BY pet.fecha_alta ASC ');
        return $query->getResult();
    }

    public function mascotas_disponibles_nuevas(): array{
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT pet FROM App\Entity\Mascota pet WHERE pet.estado IN (1,2,3) AND pet.aprobada = true ORDER BY pet.fecha_alta DESC ');
        return $query->getResult();
    }

    public function pendiente_aprobar(): array{
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT pet FROM App\Entity\Mascota pet WHERE pet.estado IN (1,2,3) AND pet.aprobada = false ');
        return $query->getResult();
    }

    public function filtro_mascota($antiguedad, $animal, $provincia): array{

        $entityManager = $this->getEntityManager();

        # Comprobamos el tipo de animal
        if($animal == 'todas'){
            if($provincia == 'todas'){
                if($antiguedad == 'nueva'){
                    $query = $entityManager->createQuery('SELECT pet FROM App\Entity\Mascota pet WHERE pet.estado IN (1,2,3) AND pet.aprobada = true ORDER BY pet.fecha_alta DESC');
                }
                else{
                    $query = $entityManager->createQuery('SELECT pet FROM App\Entity\Mascota pet WHERE pet.estado IN (1,2,3) AND pet.aprobada = true ORDER BY pet.fecha_alta ASC');
                }
                return $query->getResult();
            }
            else{ // Provincia específica
                if($antiguedad == 'nueva'){
                    $query = $entityManager->createQuery(
                        'SELECT pet FROM App\Entity\Mascota pet, App\Entity\Usuario user 
                        WHERE pet.usuario = user.id AND pet.estado IN (1,2,3) AND pet.aprobada = true AND user.provincia = :provincia 
                        ORDER BY pet.fecha_alta DESC');
                }
                else{
                    $query = $entityManager->createQuery(
                        'SELECT pet FROM App\Entity\Mascota pet, App\Entity\Usuario user 
                        WHERE pet.usuario = user.id AND pet.estado IN (1,2,3) AND pet.aprobada = true AND user.provincia = :provincia 
                        ORDER BY pet.fecha_alta ASC');
                }
                return $query->setParameter('provincia', $provincia)->getResult();
            }
        }
        else{ // Animal especifico
            if($provincia == 'todas'){
                if($antiguedad == 'nueva'){
                    $query = $entityManager->createQuery(
                        'SELECT pet FROM App\Entity\Mascota pet, App\Entity\TipoMascota tipo
                        WHERE pet.tipo = tipo.id AND pet.estado IN (1,2,3) AND pet.aprobada = true AND tipo.tipo = :tipo ORDER BY pet.fecha_alta DESC ');
                    
                }
                else{
                    $query = $entityManager->createQuery(
                        'SELECT pet FROM App\Entity\Mascota pet, App\Entity\TipoMascota tipo
                        WHERE pet.tipo = tipo.id AND pet.estado IN (1,2,3) AND pet.aprobada = true AND tipo.tipo = :tipo ORDER BY pet.fecha_alta ASC ');
                }
                return $query->setParameter(':tipo', $animal)->getResult();
            }
            else{ // Provincia específica
                if($antiguedad == 'nueva'){
                    $query = $entityManager->createQuery(
                        'SELECT pet FROM App\Entity\Mascota pet, App\Entity\TipoMascota tipo, App\Entity\Usuario user 
                        WHERE pet.tipo = tipo.id AND pet.usuario = user.id AND pet.estado IN (1,2,3) AND pet.aprobada = true AND tipo.tipo = :tipo AND user.provincia = :provincia ORDER BY pet.fecha_alta DESC ');
                }
                else{
                    $query = $entityManager->createQuery(
                        'SELECT pet FROM App\Entity\Mascota pet, App\Entity\TipoMascota tipo, App\Entity\Usuario user 
                        WHERE pet.tipo = tipo.id AND pet.usuario = user.id AND pet.estado IN (1,2,3) AND pet.aprobada = true AND tipo.tipo = :tipo AND user.provincia = :provincia ORDER BY pet.fecha_alta ASC ');
                }
                return $query->setParameter(':tipo', $animal)->setParameter('provincia', $provincia)->getResult();
            }
        }
    }
}
