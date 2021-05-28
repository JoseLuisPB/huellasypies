<?php
// src/Security/AccessDeniedHandler.php
namespace App\Seguridad;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccessDeniedHandler extends AbstractController implements AccessDeniedHandlerInterface 
{
    public function handle(Request $request, AccessDeniedException $accessDeniedException): ?Response
    {

        return $this->render('pagina_prohibido.html.twig');
    }
}
?>