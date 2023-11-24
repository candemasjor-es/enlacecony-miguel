<?php

namespace App\Form;

use App\Entity\Personas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttendType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Nombres', TextType::class, [
            'attr' => [
                'class' => 'form-control mb-3 font-family: Edwardian;',
            ],
            'label' => 'Nombre',
            'label_attr' => ['class' => 'label-formularop'],
        ])
        ->add('Apellidos', TextType::class, [
            'attr' => [
                'class' => 'form-control mb-3',
            ],
            'label' => 'Apellido',
            'label_attr' => ['class' => 'label-formularop'],
        ])
        ->add('Elegir_menu', ChoiceType::class, [
            'choices' => [
                'Menú Normal' => 'Menú Normal',
                'Menú Vegan@' => 'Menú Vegana',
                'Menú Vegetarian@' => 'Menú Vegetariana',
                'Menú Para Alergenas' => 'Menú Para Alergenas',
                'Otro' => 'Otro',
            ],
            'choice_attr' => [
                'class' => 'form-select',
            ],
            'attr' => [
                'class' => 'menu-radio form-select mb-3',
                'aria-label' => 'Elegir menú',
                'id' => 'elegir_menu_id',
            ],
            'label' => 'Elegir Menu',
            'label_attr' => ['class' => 'label-formularop'],
        ])
        ->add('Evento', ChoiceType::class, [
            'choices' => [
                'Coche' => 'Coche',
                'Autobus' => 'Autobus',
            ],
            'choice_attr' => [
                'class' => 'form-select',
            ],
            'attr' => [
                'class' => 'form-select mb-3',
            ],
            'label' => '¿Como vas al evento?',
            'label_attr' => ['class' => 'label-formularop'],
        ])
        ->add('otro', TextareaType::class, [
            'attr' => [
                'class' => 'form-control mb-3 other-text',
                'rows' => 3,
            ],
            'required' => false,
            'data' => 'null',
            'label' => 'Otros: especificar que necesidad especial',
            'label_attr' => ['class' => 'form-label label-formularop'],
        ])
        ->add('Cancion_favorito', TextareaType::class, [
            'attr' => [
                'class' => 'form-control mb-3 other-text',
                'rows' => 3,
            ],
            'required' => false,
            'data' => 'null',
            'label' => '¿Tu canción favorito?',
            'label_attr' => ['class' => 'form-label label-formularop'],
        ])
        ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personas::class,
        ]);
    }
}
