<?php

namespace App\Form;

use App\DataTransformer\RolesToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RolesType extends AbstractType
{
    private $rolesTransformer;

    public function __construct(RolesToArrayTransformer $rolesTransformer)
    {
        $this->rolesTransformer = $rolesTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles', HiddenType::class, [
                'model_transformer' => $this->rolesTransformer,
            ]);
    }

    public function getBlockPrefix()
    {
        return 'roles';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
    
}
