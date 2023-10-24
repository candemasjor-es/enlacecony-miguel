<?php

namespace App\Form;

use App\Entity\PersonasPequenos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PersonasPequenosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombres', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3 font-family: Edwardian;'
                ],
                'label' => 'Nombre',
                'label_attr' => ['class' => 'label-formularop'],
            ])
            ->add('Apellidos', TextType::class, [
                'attr' => [
                    'class' => 'form-control mb-3'
                ],
                'label' => 'Apellido',
                'label_attr' => ['class' => 'label-formularop'],
            ])
            ->add('tronas', ChoiceType::class, [
                'choices' => [
                    'Sí' => true,
                    'No' => false,
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'btn-check btn btn-outline-primary',
                ],
                'label' => '¿Necesito tronas?',
                'label_attr' => ['class' => 'label-formularop form-check-label'],
            ])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonasPequenos::class,
        ]);
    }
}
