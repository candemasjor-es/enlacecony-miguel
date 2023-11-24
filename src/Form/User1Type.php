<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Adminstrador' => 'ROLE_ADMIN',
                    'Usuarios nuevo' => 'ROLE_USER',
                    'Si asisto' => 'ROLE_YES',
                    'No asisto' => 'ROLE_NO',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('password')
            ->add('name', TextType::class)
            ->add('surnames', TextType::class)
            ->add('phome', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
