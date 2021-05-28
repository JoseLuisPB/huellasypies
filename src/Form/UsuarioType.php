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

class UsuarioType extends AbstractType
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
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'El valor de los campos password tienen que ser iguales',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repetir Password'],
            ])
            ->add('telefono', TextType::class)
            ->add('rol',ChoiceType::class, [
                'choices' => [
                    'Particular' => 'ROLE_PARTICULAR',
                    'Protectora' => 'ROLE_PROTECTORA',
                ], 'label' => 'Soy'])
            ->add('direccion', TextType::class, array('label' => 'Dirección de la página web'))
            ->add('save', SubmitType::class, array('label' => 'Enviar'))->getForm();
    }
}
?>