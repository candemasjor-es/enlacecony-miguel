<?php

namespace App\Form;

use App\Entity\Personas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nombres')
            ->add('Apellidos')
            ->add('Elegir_menu')
            ->add('Evento')
            ->add('otro')
            ->add('User')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personas::class,
        ]);
    }
}
