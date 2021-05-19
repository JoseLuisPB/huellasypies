<?php

namespace App\Controller;

use App\Entity\Noticia;
use App\Entity\Mascota;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InicioController extends AbstractController
{
    /** 
     * * @Route("/", name="inicio") 
     * */
    public function inicio()
    {
        // Datos de las mascotas
        /**
         * @var MascotaRepository
         */
        $repositorio_mascotas = $this->getDoctrine()->getRepository(Mascota::class);
        $ultimasMascotas = $repositorio_mascotas->ultimas_mascotas();


        // Datos de las noticias
        /**
         * @var NoticiaRepository
         */
        $repositorio_noticias = $this->getDoctrine()->getRepository(Noticia::class);
        $ultimasNoticias = $repositorio_noticias->ultimas_noticias();

        
        
        return $this->render('inicio.html.twig',array('mascotas' => $ultimasMascotas,'noticias' => $ultimasNoticias));
    }
}
?>