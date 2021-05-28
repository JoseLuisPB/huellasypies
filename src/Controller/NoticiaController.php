<?php

namespace App\Controller;

use App\Entity\Noticia;
use App\Entity\Usuario;
use App\Form\NoticiaType;
use App\Form\EditarNoticiaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class NoticiaController extends AbstractController
{
    /** 
     * * @Route("/noticia/crear", name="crear_noticia") 
     * */
    public function crear_noticia(Request $request, SluggerInterface $slugger)
    {
                # Se crea un objeto de la clase Usuario, que será la que utilizaremos para guardar los datos en la BD
                $crear_noticia = new Noticia();

                # Construcción del formulario en una clase externa, le pasamos el objeto que contendrá los datos
                $form = $this->createForm(NoticiaType::class, $crear_noticia);
        
                # Operaciones de validación del formulario
                $form->handleRequest($request);
                
                if ($form->isSubmitted() && $form->isValid()) {
                    try{
                       // $imagen_subida = $form->get('foto')->getData();
                        // Autor fecha
                        $fecha = date('Y-m-d');
                        $crear_noticia->setPublicada($fecha);

                        $imagen = $form->get('foto')->getData();

                        if ($imagen){
                            $originalFilename = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
                        // this is needed to safely include the file name as part of the URL
                        $safeFilename = $slugger->slug($originalFilename);
                        $newFilename = $safeFilename.'-'.uniqid().'.'.$imagen->guessExtension();

                            // Move the file to the directory where brochures are stored
                            try {
                                $imagen->move(
                                    $this->getParameter('carpeta_noticias'),
                                    $newFilename
                                );
                            } catch (FileException $e) {
                                // ... handle exception if something happens during file upload
                            }

                            // updates the 'brochureFilename' property to store the PDF file name
                            // instead of its contents
                        $crear_noticia->setFoto($newFilename);
                        }

                        $cuerpo_noticia = $form->get('cuerpo')->getData();
                        // Eliminamos las etiquetas html
                        $noticia_sin_etiquetas = strip_tags ( $cuerpo_noticia );
                        $noticia_preparada = htmlspecialchars_decode($noticia_sin_etiquetas);
                        $resumen = substr($noticia_preparada, 0, 273);

                        $crear_noticia->setResumen($resumen);

                        $usuario = $this->getUser()->getId();
                        $repositorio = $this->getDoctrine()->getRepository(Usuario::class);
                        $autor = $repositorio->find($usuario);
                        $crear_noticia->setAutor($autor);

                        # Guardado en la base de datos
                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist( $crear_noticia);
                        $entityManager->flush();

                        # Enviar el mensaje flash para mostarlo en el panel de control
                        $this->addFlash('success','Noticia creada con éxito');

                        # Carga de la pantalla inicio
                        return $this->redirectToRoute('noticias_usuario');
                    }
                    catch(\Exception $e){
                        $this->addFlash('error','La mascota no se ha podido crear');
                        return $this->render('noticia_crear.html.twig', array('formularioPasado' => $form->createView()));
                    } 
        
                }
        return $this->render('noticia_crear.html.twig', array('formularioPasado' => $form->createView()));
    }

    /** 
     * * @Route("/noticia/editar/{id}", name="editar_noticia") 
     * */
    public function editar_noticia(Request $request, SluggerInterface $slugger, $id)
    {

                $repositorio = $this->getDoctrine()->getRepository(Noticia::class);
                $datosNoticia = $repositorio->find($id);

                if($this->getUser()->getId() == $datosNoticia->getAutor()->getId()){
                # Construcción del formulario en una clase externa, le pasamos el objeto que contendrá los datos
                $form = $this->createForm(EditarNoticiaType::class, $datosNoticia);
        
                # Operaciones de validación del formulario
                $form->handleRequest($request);
                
                if ($form->isSubmitted() && $form->isValid()) {

                    try{

                        $imagen = $form->get('nueva_foto')->getData();

                        if ($imagen){
                        $originalFilename = pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME);
                        // this is needed to safely include the file name as part of the URL
                        $safeFilename = $slugger->slug($originalFilename);
                        $newFilename = $safeFilename.'-'.uniqid().'.'.$imagen->guessExtension();

                        // Move the file to the directory where brochures are stored
                            try {
                                $imagen->move(
                                    $this->getParameter('carpeta_noticias'),
                                    $newFilename
                                );
                            } catch (FileException $e) {
                                // ... handle exception if something happens during file upload
                            }

                            // updates the 'brochureFilename' property to store the PDF file name
                            // instead of its contents
                            $datosNoticia->setFoto($newFilename);
                        }

                        $cuerpo_noticia = $form->get('cuerpo')->getData();
                        // Eliminamos las etiquetas html
                        $noticia_sin_etiquetas = strip_tags ( $cuerpo_noticia );
                        $noticia_preparada = htmlspecialchars_decode($noticia_sin_etiquetas);
                        $resumen = substr($noticia_preparada, 0, 273);
                        $datosNoticia->setResumen($resumen);

                        # Guardado en la base de datos
                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($datosNoticia);
                        $entityManager->flush();

                        # Enviar el mensaje flash para mostarlo en el panel de control
                        $this->addFlash('success','Noticia editada con éxito');

                        # Carga de la pantalla inicio
                        return $this->redirectToRoute('noticias_usuario');
                    }
                    catch(\Exception $e){
                        $this->addFlash('error','La noticia no se ha podido editar');
                        return $this->render('noticia_editar.html.twig', array('formularioPasado' => $form->createView()));
                    } 
        
                }

                    return $this->render('noticia_editar.html.twig', array('formularioPasado' => $form->createView()));
                }
                else{
                    $this->addFlash('error','No puedes editar noticias de otros usuarios');
                    return $this->redirectToRoute('noticias_usuario'); 
                }

    }

    /** 
     * * @Route("/noticias/usuario", name="noticias_usuario") 
     * */
    public function noticias_usuario()
    {
        $id = $this->getUser()->getId();
        /**
         * @var NoticiaRepository
         */
        $repositorio = $this->getDoctrine()->getRepository(Noticia::class);
        $noticias = $repositorio->noticias_usuario($id);

        return $this->render('noticia_lista.html.twig', array('noticias' => $noticias));
    }

    /** 
     * * @Route("/pagina_noticias", name="pagina_noticias") 
     * */
    public function pagina_noticias(){
         // Datos de las noticias
        /**
         * @var NoticiaRepository
         */
        $repositorio_noticias = $this->getDoctrine()->getRepository(Noticia::class);
        $noticias = $repositorio_noticias->lista_noticias();

        return $this->render('pagina_noticia.html.twig',array('noticias' => $noticias));
    }

    /** 
     * * @Route("/detalle_noticia/{id}", name="detalle_noticia") 
     * */
    public function detalle_noticia($id){
        $repositorio = $this->getDoctrine()->getRepository(Noticia::class);
        $datosNoticia = $repositorio->find($id);

        return $this->render('detalle_noticia.html.twig',array('noticia' => $datosNoticia));
    }
}
?>