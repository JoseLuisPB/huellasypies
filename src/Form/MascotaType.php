<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\TipoMascota;

class MascotaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array('label' => 'Nombre'))
            ->add('tipo', EntityType::class, array(
                'class' => TipoMascota::class, 
                'choice_label' => 'tipo', 
                'label' => 'Tu mascota es',))
            ->add('foto', FileType::class)
            ->add('descripcion', TextareaType::class, array('label' => 'Descripción', 'required' => false, 'attr' =>['rows' => '20']))
            ->add('requisitos', TextareaType::class, array('label' => 'Requisitos (No es obligatorio)', 'required' => false, 'required' => false ,'attr' =>['rows' => '20']))
            ->add('vacunado', CheckboxType::class, ['label' => 'Vacunado', 'required' => false])
            ->add('desparasitado', CheckboxType::class, ['label' => 'Desparasitado', 'required' => false])
            ->add('esterilizado', CheckboxType::class, ['label' => 'Esterilizado', 'required' => false])
            ->add('microchip', CheckboxType::class, ['label' => 'Chip', 'required' => false])
            ->add('save', SubmitType::class, array('label' => 'Enviar'))->getForm();
    }
}
?>