<?php
// src/Form/Back/Permission/ModifyRoleType.php

namespace App\Form\Back\Permission;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModifyRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('role', HiddenType::class, [
                'data' => $options['role'], // Valeur par défaut du rôle, cachée
            ])
            ->add('label', TextType::class, [
                'label' => 'Description du rôle',
                'label_attr' => ['class' => 'color-yellow text-bold mb-3'],
                'data' => $options['label'], // Remplir avec l'ancien label
                'constraints' => [
                    new NotBlank(['message' => 'Le label ne peut pas être vide.']), // Validation pour ne pas laisser le champ vide
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => ['class' => 'btn-yellow-form mt-2 text-bold'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null, // Ici, il n'y a pas de classe de données
            'role' => null, // Option pour passer le rôle
        ]);
    }
}
