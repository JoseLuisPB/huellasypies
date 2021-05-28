<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Usuario;
use App\Entity\Rol;

class EditarUsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('poblacion', TextType::class)
            ->add('provincia',ChoiceType::class, [
                'choices' => [
                    'Alicante' => 'Alicante',
                    'Valencia' => 'Valencia',
                    'Castellón' => 'Castellon',
                ], 'label' => 'Provincia'])
            ->add('email', EmailType::class)
            ->add('telefono', TextType::class)
            ->add('direccion', TextType::class, array('label' => 'Dirección de la página web'))
            ->add('save', SubmitType::class, array('label' => 'Guardar'))->getForm();
    }
}
?>