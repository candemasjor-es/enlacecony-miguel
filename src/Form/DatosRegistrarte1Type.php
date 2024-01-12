<?php

namespace App\Form;

use App\Entity\DatosRegistrarte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DatosRegistrarte1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nombre',
                    'class' => 'form-control mb-3',
                ],
                'label' => false,
            ])
            ->add('apellidos', TextType::class, [
                'attr' => [
                    'placeholder' => 'Apellido',
                    'class' => 'form-control mb-3',
                ],
                'label' => false,
            ])
            ->add('email', EmailType::class, [
                'required' => false, // Permite que el campo no sea obligatorio
                'mapped' => false,   // Evita que el campo se asocie con una propiedad de la entidad
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DatosRegistrarte::class,
        ]);
    }
}
