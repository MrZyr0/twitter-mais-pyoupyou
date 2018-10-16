<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstname', TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Prénom',
            ],
        ])
        ->add('lastname', TextType::class,[
            'label' => false,
            'attr' => [
                'placeholder' => 'Nom',
            ],
        ])
        ->add('username', TextType::class,[
            'label' => false,
            'attr' => [
                'placeholder' => "Nom d'utilisateur (@Nom)",
            ],
        ])
        ->add('email', EmailType::class,[
            'label' => false,
            'attr' => [
                'placeholder' => 'Email',
            ],
        ])
        ->add('password', PasswordType::class,[
            'label' => false,
            'attr' => [
                'placeholder' => 'Mot de Passe',
            ],
        ])
        ->add('submit', SubmitType::class, [
            'label' => "S'inscrire",
            'attr' => [
                'class' => 'btn btn-primary',
            ]
        ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}


// TODO: add support for picture + cover + links
