<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\RolesType;

class AttendType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name',TextType::class,[
            'attr' => [
                'placeholder' => 'Nombre',
                'class' => 'form-control mb-3'
            ],
            'label' => false 
        ])
        ->add('surnames',TextType::class,[
            'attr' => [
                'placeholder' => 'Apellidos',
                'class' => 'form-control mb-3'
            ],
            'label' => false 
        ])
        ->add('phome',TextType::class,[
            'attr' => [
                'placeholder' => 'Telefono',
                'class' => 'form-control mb-3'
            ],
            'label' => false 
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
