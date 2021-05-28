<?php

namespace App\Controller;

use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UsuarioType;
use App\Form\EditarUsuarioType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsuarioController extends AbstractController
{
    /** 
     * * @Route("/usuario/nuevo", name="nuevo_usuario") 
     * */
    public function nuevo_usuario(Request $request, UserPasswordEncoderInterface $encoder)
    {
        # Se crea un objeto de la clase Usuario, que será la que utilizaremos para guardar los datos en la BD
        $nuevoUsuario = new Usuario();

        # Construcción del formulario en una clase externa, le pasamos el objeto que contendrá los datos
        $form = $this->createForm(UsuarioType::class, $nuevoUsuario);

        # Operaciones de validación del formulario
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            try{
                
                # Recuperamos los datos del formulario y los guardamos en el objeto $nuevoUsuario
                $nuevoUsuario = $form->getData();
                # Rellenamos los campos de base de datos que no dependen del formulario
                $nuevoUsuario->setActivo(true);
                $nuevoUsuario-> setReiniciarPassword(false);
                $fecha = date('Y-m-d');
                $nuevoUsuario->setFechaAlta($fecha);
                $email = $nuevoUsuario->getEmail();
                $nuevoUsuario->setLogin($email);
                
                # Codificamos el password que nos ha enviado el formulario
                $passwordCodificado = $encoder->encodePassword($nuevoUsuario, $form['password']->getData());
                # Cambiamos el valor valor antiguo del password que tiene el objeto por el nuevo que acabamos de codificar 
                $nuevoUsuario->setPassword($passwordCodificado);

                # Guardado en la base de datos
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist( $nuevoUsuario);
                $entityManager->flush();
                # Carga de la pantalla inicio
                return $this->redirectToRoute('inicio');
            }
            catch(\Exception $e){
                return $this->render('login.html.twig', array('formularioPasado' => $form->createView()));
            } 

        }

        # Se devuelve la vista que contiene el formulario -> Esto sucede cuando el formulario no se ha enviado o no es válido
        return $this->render('usuario_alta.html.twig', array('formularioPasado' => $form->createView()));

    }

    /** 
     * * @Route("/usuario/editar/{id}", name="editar_usuario") 
     * */
    public function editar_usuario(Request $request, $id)
    {
        // Comprobamos que el usuario logueado se corresponde con el $id enviado en la ruta
        if($this->getUser()->getId() == $id){

        # Para poder editar un usuario, primero tenemos que recuperarlo de la base de datos
        $repositorio = $this->getDoctrine()->getRepository(Usuario::class);
        $datosUsuario = $repositorio->find($id);

        $form = $this->createForm(EditarUsuarioType::class, $datosUsuario);

        # Operaciones de validación del formulario
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                
                $datosUsuario = $form->getData();
                $email = $form->get('email')->getData();
                $datosUsuario->setLogin($email);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($datosUsuario);
                $entityManager->flush();

                # Enviar el mensaje flash para mostarlo en el panel de control
                $this->addFlash('success','Perfil editado con éxito');
                return $this->redirectToRoute('panel_control');
            }
        return $this->render('usuario_editar.html.twig', array('formularioPasado' => $form->createView()));
        }
        else{
            return $this->redirectToRoute('panel_control'); 
        }
        
    }
}
?>