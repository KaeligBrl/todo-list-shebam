<?php
// src/Form/Back/User/ModifyUserType.php

namespace App\Form\Back\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModifyUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => false,
                'label_attr' => ['class' => 'label-custom'],
            ])
            ->add('firstname', TextType::class, [
                'label' => false,
                'label_attr' => ['class' => 'label-custom'],
            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'label_attr' => ['class' => 'label-custom'],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => $options['roles_choices'], // Utiliser les choix passés
                'label' => false,
                'label_attr' => ['class' => 'label-custom color-yellow'],
                'expanded' => false, // Liste déroulante (par défaut, expanded est false)
                'multiple' => false, // Sélection unique
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => ['class' => 'btn-yellow-form mt-2 text-bold'],
            ]);

        $builder->get('roles')->addModelTransformer(new CallbackTransformer(
            function ($rolesArray) {
                // Transforme le tableau en une chaîne, prends seulement le premier rôle
                return isset($rolesArray[0]) ? $rolesArray[0] : null;
            },
            function ($roleString) {
                // Transforme la chaîne en tableau
                return [$roleString];
            }
        ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'roles_choices' => [], // Ajoutez cette ligne pour définir une option par défaut
        ]);
    }
}