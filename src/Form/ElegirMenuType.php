<?php

namespace App\Form;

use App\Entity\ElegirMenu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ElegirMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
        ->add('Menu_name', ChoiceType::class,[
            'choices' => [
                'Menú Normal' => 'Menú Normal',
                'Menú Vegan@' => 'Menú Vegana',
                'Menú Vegetarian@' => 'Menú Vegetariana',
                'Menú Para Alergenas' => 'Menú Para Alergenas',
                'Otro' => 'Otro',
            ],
            'choice_attr' => [
                'class' => 'form-check-input'
            ],
            'expanded' => true,
            'multiple' => false,
            'attr' => [
                'class' => 'menu-radio'
            ],
            'label_attr' => [
                'class' => 'form-check-label text-start',
            ],
        ])
        ->add('text', TextType::class, [
            'required' => true,
            'label' => '(Especificar qué necesidad especial) escribe aquí ',
            'label_attr' => [
                'class' => 'hidden-label',
            ],
            'attr' => [
                'class' => 'other-text',
            ],
        ]);
        
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ElegirMenu::class,
        ]);
    }
    
}
