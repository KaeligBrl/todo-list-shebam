<?php
// src/Form/Back/Role/ModifyRoleType.php

namespace App\Form\Back\Role;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModifyType extends AbstractType
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
                'constraints' => [new NotBlank()], // Assurez-vous que le label n'est pas vide
            ])
            ->add('show_p2_button', CheckboxType::class, [
                'label' => 'Bouton P2',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, // Ne pas obliger ce champ
                'data' => $options['show_p2_button'], // Valeur par défaut
            ])

            ->add('show_task_p1_cw_to_p1_nw_button', CheckboxType::class, [
                'label' => 'Bouton P1 vers semaine suivante',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, // Ne pas obliger ce champ
                'data' => $options['show_task_p1_cw_to_p1_nw_button'], // Valeur par défaut
            ])
            ->add('show_task_p1_modify_button', CheckboxType::class, [
                'label' => 'Bouton  modifier P1',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, // Ne pas obliger ce champ
                'data' => $options['show_task_p1_modify_button'], // Valeur par défaut
            ])
            ->add('show_task_p1_delete_button', CheckboxType::class, [
                'label' => 'Bouton supprimer P1',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, // Ne pas obliger ce champ
                'data' => $options['show_task_p1_delete_button'], // Valeur par défaut
            ]) 
            ->add('show_switch_to_cw', CheckboxType::class, [
                'label' => 'Basculter en semaine actuelle',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, // Ne pas obliger ce champ
                'data' => $options['show_switch_to_cw'], // Valeur par défaut
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Mettre à jour',
                'attr' => ['class' => 'btn-yellow-form mt-2 text-bold'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'role' => null, 
            'label' => null,
            'show_p2_button' => null,
            'show_task_p1_cw_to_p1_nw_button' => null,
            'show_task_p1_modify_button' => null,
            'show_task_p1_delete_button' => null,
            'show_switch_to_cw' => null
        ]);
    }
}