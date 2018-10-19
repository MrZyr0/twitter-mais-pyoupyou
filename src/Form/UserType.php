<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('username')
            ->add('password')
            ->add('lastname')
            ->add('firstname')
            ->add('picture')
            ->add('cover')
            ->add('links')
            ->add('role')
            ->add('statut')
            ->add('isPublic')
            ->add('isActive')
            ->add('pinPyoupyou')
            ->add('project')
            ->add('reposts')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
