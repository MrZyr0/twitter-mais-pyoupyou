<?php

namespace App\Form;

use App\Entity\Pyoupyou;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PyoupyouType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message')
            ->add('date')
            ->add('isPublic')
            ->add('user')
            ->add('project')
            ->add('incubator')
            ->add('repostUsers')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pyoupyou::class,
        ]);
    }
}
