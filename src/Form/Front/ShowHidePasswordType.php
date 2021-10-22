<?php

namespace App\Form\Front;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ShowHidePasswordType extends AbstractType
{
    public function getParent()
    {
        return PasswordType::class;
    }
    // public function buildForm(FormBuilderInterface $builder, array $options)
    // {
    //     $builder
    //         ->add('email')
    //         ->add('roles')
    //         ->add('password')
    //         ->add('firstname')
    //         ->add('lastname')
    //     ;
    // }

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //         'data_class' => User::class,
    //     ]);
    // }
}
