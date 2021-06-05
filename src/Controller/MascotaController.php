<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Mascota;
use App\Entity\Usuario;
use App\Entity\EstadoMascota;
use App\Form\MascotaType;
use App\Form\EditarMascotaType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MascotaController extends AbstractController
{
    /** 
     * * @Route("/mascota/crear", name="crear_mascota") 
     * */
    public function crear_mascota(Request $request, SluggerInterface $slugger)
    {

        $nuevaMascota = new Mascota();
        $form = $this->createForm(MascotaType::class, $nuevaMascota);

        # Operaciones de validación del formulario
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            try{
                
                $nuevaMascota = $form->getData();
                
                # Rellenamos los campos de base de datos que no dependen del formulario
                $fecha = date('Y-m-d');
                $nuevaMascota->setFechaAlta($fecha);

                # Estado de la mascota -> Al crearse siempre se crea en disponible
                $repositorio_estado_mascota = $this->getDoctrine()->getRepository(EstadoMascota::class);
                $estadoMascota = $repositorio_estado_mascota->find(1);
                $nuevaMascota->setEstado($estadoMascota);
                
                # Dueño de la mascota
                $duenyo = $this->getUser()->getId();
                $repositorio_usuario = $this->getDoctrine()->getRepository(Usuario::class);
                $usuario = $repositorio_usuario->find($duenyo);
                $nuevaMascota->setUsuario($usuario);
                $nuevaMascota->setRechazada(false);

                # Si el creador es un particular ponemos la mascota en estado modificado para que sea aprobada.
                if($usuario->getRol() == 'ROLE_PROTECTORA'){
                    $nuevaMascota->setAprobada(true);
                }
                else{
                    $nuevaMascota->setAprobada(false);
                }
                
                # Guardar la imagen en la carpeta y la ruta para llegar a ella en BD
                $imagen = $form->get('foto')->getData();

                    if ($imagen){
                        $originalFilename = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
                        $safeFilename = $slugger->slug($originalFilename);
                        $newFilename = $safeFilename.'-'.uniqid().'.'.$imagen->guessExtension();

                        try {
                            $imagen->move(
                                $this->getParameter('carpeta_mascotas'),
                                $newFilename
                            );
                        } catch (FileException $e) {
                                
                        }

                        $nuevaMascota->setFoto($newFilename);
                        }

                # Guardado en la base de datos
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist( $nuevaMascota);
                $entityManager->flush();
                
                # Enviar el mensaje flash para mostarlo en el panel de control
                $this->addFlash('success','Mascota creada con éxito');
                return $this->redirectToRoute('mascotas_usuario');
                }
                catch(\Exception $e){
                    $this->addFlash('error','La mascota no se ha podido crear');
                    return $this->render('panel_control.html.twig', array('formularioPasado' => $form->createView()));
                } 
            }
        # Se devuelve la vista que contiene el formulario -> Esto sucede cuando el formulario no se ha enviado o no es válido
        return $this->render('mascota_crear.html.twig', array('formularioPasado' => $form->createView()));
    }

    /** 
     * * @Route("/mascota/editar/{id}", name="editar_mascota") 
     * */
    public function editar_mascota(Request $request, $id, SluggerInterface $slugger){
                
                $repositorio_mascota = $this->getDoctrine()->getRepository(Mascota::class);
                $datosMascota = $repositorio_mascota->find($id);

                // Comprobamos que el usuario logueado tiene el mismo id de la mascota que quiere editar
                if($this->getUser()->getId() == $datosMascota->getUsuario()->getId()){
                                    
                $form = $this->createForm(EditarMascotaType::class, $datosMascota);   
                # Operaciones de validación del formulario
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
        
                    try{
                        
                        $datosMascota = $form->getData();
                        
                        # Estado de la mascota
                        $estado = $form->get('estado')->getData();
                        $repositorio_estado_mascota = $this->getDoctrine()->getRepository(EstadoMascota::class);
                        $estadoMascota = $repositorio_estado_mascota->find($estado);
                        $datosMascota->setEstado($estadoMascota);
                        $datosMascota->setRechazada(false);

                        # Dueño de la mascota
                        $duenyo = $this->getUser()->getId();
                        $repositorio_usuario = $this->getDoctrine()->getRepository(Usuario::class);
                        $usuario = $repositorio_usuario->find($duenyo);
                        $datosMascota->setUsuario($usuario);

                        # Si el creador es un particular ponemos la mascota en estado modificado para que sea aprobada.
                        if($usuario->getRol() == 'ROLE_PROTECTORA' || $estadoMascota->getEstado() == "Adoptada"){
                            $datosMascota->setAprobada(true);
                        }
                        else{
                            $datosMascota->setAprobada(false);
                        }
                        
                        # Si la mascota tiene el estado adoptada se actualiza la fecha de adopción.
                        if($estadoMascota->getEstado() == "Adoptada"){
                            $fecha = date('Y-m-d');
                            $datosMascota->setFechaAdopcion($fecha);
                        }
                        $imagen = $form->get('nueva_foto')->getData();
        
                            if ($imagen){

                            $originalFilename = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
                            $safeFilename = $slugger->slug($originalFilename);
                            $newFilename = $safeFilename.'-'.uniqid().'.'.$imagen->guessExtension();
        
                                try {
                                    $imagen->move(
                                        $this->getParameter('carpeta_mascotas'),
                                        $newFilename
                                    );
                                } catch (FileException $e) {

                                }

                                $datosMascota->setFoto($newFilename);
                            }
        
                        # Guardado en la base de datos
                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist( $datosMascota);
                        $entityManager->flush();
                        
                        # Enviar el mensaje flash para mostarlo en el panel de control
                        $this->addFlash('success','Mascota editada con éxito');
                        return $this->redirectToRoute('mascotas_usuario');
                        }
                        catch(\Exception $e){
                            # Enviar el mensaje flash para mostarlo en el panel de control
                            $this->addFlash('error','La mascota no se ha podido editar');
                            return $this->render('panel_control.html.twig', array('formularioPasado' => $form->createView()));
                        } 
                    }
                # Se devuelve la vista que contiene el formulario -> Esto sucede cuando el formulario no se ha enviado o no es válido
                return $this->render('mascota_editar.html.twig', array('formularioPasado' => $form->createView()));
                }
                else{
                    $this->addFlash('error','No puedes editar mascotas de otros usuarios');
                    return $this->redirectToRoute('mascotas_usuario'); 
                }

    }

    /** 
     * * @Route("/mascotas/usuario", name="mascotas_usuario") 
     * */
    public function mascotas_usuario()
    {
        $id = $this->getUser()->getId();
        /**
         * @var MascotaRepository
         */

        // Mascotas del usuario
        $repositorio = $this->getDoctrine()->getRepository(Mascota::class);
        $mascotas = $repositorio->mascotas_usuario($id);

        /**
         * @var MascotaRepository
         */
        // Mascotas pendientes de aprobación
        $repositorio_pendientes = $this->getDoctrine()->getRepository(Mascota::class);
        $pendientes = $repositorio_pendientes->pendiente_aprobar();

        return $this->render('mascota_lista.html.twig', array('mascotas' => $mascotas, 'pendientes' => $pendientes));
    }

    /** 
     * * @Route("/pagina_mascotas", name="pagina_mascotas") 
     * */
    public function pagina_mascotas()
    {
        /**
         * @var MascotaRepository
         */
        $repositorio = $this->getDoctrine()->getRepository(Mascota::class);
        $mascotas = $repositorio->mascotas_disponibles_nuevas();

        return $this->render('pagina_mascotas.html.twig', array('mascotas' => $mascotas, 'selects' => ['antiguedad' => 'nueva', 'animal' => 'todas', 'provincia' => 'todas']));
    }

    /** 
     * * @Route("/detalle_mascota/{id}", name="detalle_mascota") 
     * */
    public function detalle_mascota($id)
    {
        
        $repositorio_mascota = $this->getDoctrine()->getRepository(Mascota::class);
        $mascota = $repositorio_mascota->find($id);

        return $this->render('detalle_mascota.html.twig', array('mascota' => $mascota));
    }

    /** 
     * * @Route("/lista_aprobar", name="lista_aprobar") 
     * */
    public function lista_aprobar()
    {
        /**
         * @var MascotaRepository
         */
        $repositorio_mascota = $this->getDoctrine()->getRepository(Mascota::class);
        $mascotas = $repositorio_mascota->pendiente_aprobar();

        return $this->render('mascota_aprobar.html.twig', array('mascotas' => $mascotas));
    }

    /** 
     * * @Route("/aprobar_mascota/{id}", name="aprobar_mascota") 
     * */
    public function aprobar_mascota( MailerInterface $mailer,$id)
    {
        $repositorio_mascota = $this->getDoctrine()->getRepository(Mascota::class);
        $mascota = $repositorio_mascota->find($id);

        try{
            $mascota->setAprobada(true);
            # Guardado en la base de datos
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist( $mascota);
            $entityManager->flush();

            /* Enviar email de que la mascota está aprobada */
            $email = (new Email())
                ->from('no-reply@huellasypies.daw')
                ->to($mascota->getUsuario()->getEmail())
                ->subject('Mascota aprobada')
                ->html("
                    <h2>Hola {$mascota->getUsuario()->getNombre()}</h2>
                    <p>Tu mascota {$mascota->getNombre()} ha sido aprobada y a partir de ahora aparecerá en la lista de mascotas</p>
                    <p>Atentamente el equipo de huellasypies</p>
                ");

                $mailer->send(($email));


            /**
             * @var MascotaRepository
             */
            $mascotas_pendiente_aprobar = $this->getDoctrine()->getRepository(Mascota::class);
            $mascotas = $mascotas_pendiente_aprobar->pendiente_aprobar();
            $this->addFlash('success','Mascota aprobada');
            return $this->render('mascota_aprobar.html.twig', array('mascotas' => $mascotas));
        }
        catch(\Exception $e){
            # Enviar el mensaje flash para mostarlo en el panel de control
            $this->addFlash('error','La mascota no se ha podido aprobar');
            /**
            * @var MascotaRepository
            */
            $mascotas_pendiente_aprobar = $this->getDoctrine()->getRepository(Mascota::class);
            $mascotas = $mascotas_pendiente_aprobar->pendiente_aprobar();

            return $this->render('mascota_aprobar.html.twig', array('mascotas' => $mascotas));
        } 
        
    }

    /** 
     * * @Route("/pagina_rechazar/{id}", name="pagina_rechazar") 
     * */

    public function pagina_rechazar($id){
        return $this->render('pagina_rechazar.html.twig', array('id' => $id));
    }

    /** 
     * * @Route("/rechazar_mascota/{id}", name="rechazar_mascota") 
     * */
    
    public function rechazar_mascota(MailerInterface $mailer, Request $request,$id)
    {
        $repositorio_mascota = $this->getDoctrine()->getRepository(Mascota::class);
        $mascota = $repositorio_mascota->find($id);

        try{
            $mascota->setAprobada(false);
            $mascota->setRechazada(true);
            $mensaje = $request->request->get('rechazo');
            # Guardado en la base de datos
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist( $mascota);
            $entityManager->flush();

            /* Enviar email de que la mascota está aprobada */
            $email = (new Email())
                ->from('no-reply@huellasypies.daw')
                ->to($mascota->getUsuario()->getEmail())
                ->subject('Mascota rechazada')
                ->html("
                    <h2>Hola {$mascota->getUsuario()->getNombre()}</h2>
                    <p>Tu mascota {$mascota->getNombre()} ha sido rechazada, a continuación te indicamos los motivos de este rechazo</p>
                    <p>$mensaje</p>
                    <p>Atentamente el equipo de huellasypies</p>
                ");

                $mailer->send(($email));

            /**
             * @var MascotaRepository
             */
            $mascotas_pendiente_aprobar = $this->getDoctrine()->getRepository(Mascota::class);
            $mascotas = $mascotas_pendiente_aprobar->pendiente_aprobar();
            $this->addFlash('success','La mascota ha sido rechazada');
            return $this->render('mascota_aprobar.html.twig', array('mascotas' => $mascotas));
        }
        catch(\Exception $e){
            # Enviar el mensaje flash para mostarlo en el panel de control
            $this->addFlash('error','La mascota no se ha podido rechazar');
            /**
            * @var MascotaRepository
            */
            $mascotas_pendiente_aprobar = $this->getDoctrine()->getRepository(Mascota::class);
            $mascotas = $mascotas_pendiente_aprobar->pendiente_aprobar();

            return $this->render('mascota_aprobar.html.twig', array('mascotas' => $mascotas));
        }
    }
    
    /** 
     * * @Route("/filtrar_mascota", name="filtrar_mascota") 
     * */
    public function filtrar_mascota(Request $request)
    {

        /**
        * @var MascotaRepository
        */
        $repositorio = $this->getDoctrine()->getRepository(Mascota::class);
        $mascotas_disponibles = $repositorio->filtro_mascota($_POST['antiguedad'], $_POST['animal'],$_POST['provincia'] );

        return $this->render('pagina_mascotas.html.twig', array('mascotas' => $mascotas_disponibles, 'selects' => ['antiguedad' => $_POST['antiguedad'], 'animal' => $_POST['animal'], 'provincia' =>$_POST['provincia']]));
    }
}
?>