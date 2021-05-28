<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\EstadoNoticia;

class NoticiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', TextType::class, array('label' => 'Titular'))
            ->add('cuerpo', TextareaType::class, array('label' => 'Contenido', 'required' => false ,'attr' =>['rows' => '20', "white-space" => "pre-wrap", "text-indent"=>"50px"]))
            ->add('foto', FileType::class)
            ->add('estado', EntityType::class, array(
                'class' => EstadoNoticia::class, 
                'choice_label' => 'estado', 
                'label' => 'Estado de la noticia',))
            ->add('save', SubmitType::class, array('label' => 'Enviar'))->getForm();
    }
}
?>