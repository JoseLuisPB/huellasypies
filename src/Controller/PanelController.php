<?php

namespace App\Controller;

use App\Entity\Mascota;
use App\Entity\Usuario;
use App\Repository\MascotaRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PanelController extends AbstractController
{
    /** 
     * * @Route("/panel_control", name="panel_control") 
     * */
    public function panel_control()
    {

        return $this->render('panel_control.html.twig');
    }
    
}
?>