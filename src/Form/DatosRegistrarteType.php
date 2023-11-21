<?php

namespace App\Form;

use App\Entity\DatosRegistrarte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DatosRegistrarteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nombre', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nombre',
                    'class' => 'form-control mb-3'
                ],
                'label' => false
            ])
            ->add('Apellidos', TextType::class, [
                'attr' => [
                    'placeholder' => 'Apellido',
                    'class' => 'form-control mb-3'
                ],
                'label' => false
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Correo electrónico',
                    'class' => 'form-control mb-3'
                ],
                'label' => false,
                'required' => false,
            ])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DatosRegistrarte::class,
        ]);
    }
}
