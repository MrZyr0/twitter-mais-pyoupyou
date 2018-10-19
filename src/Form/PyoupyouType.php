<?php

namespace App\Form;

use App\Form\Form;
use App\Entity\Pyoupyou;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PyoupyouType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('message', TextType::class, [
            'label' => false,
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Envoyer'
        ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pyoupyou::class,
        ]);
    }
}