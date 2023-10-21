<?php

namespace App\Form;

use App\Entity\PersonasPequenos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonasPequenosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombres')
            ->add('Apellidos')
            ->add('elegir_menu')
            ->add('otro')
            ->add('tronas')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonasPequenos::class,
        ]);
    }
}
