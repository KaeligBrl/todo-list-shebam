<?php

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
                'data' => $options['role'],
            ])
            ->add('label', TextType::class, [
                'label' => 'Description du rôle',
                'label_attr' => ['class' => 'color-yellow text-bold mb-3'],
                'data' => $options['label'],
                'constraints' => [new NotBlank()],
            ])
            ->add('show_p2_button_in_cw', CheckboxType::class, [
                'label' => 'Bouton P2',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, 
                'data' => $options['show_p2_button_in_cw'], 
            ])
            ->add('show_task_p1_cw_to_p1_nw_button', CheckboxType::class, [
                'label' => 'Bouton P1 vers semaine suivante',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_task_p1_cw_to_p1_nw_button'],
            ])
            ->add('show_task_p1_modify_button', CheckboxType::class, [
                'label' => 'Bouton  modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_task_p1_modify_button'], 
            ])
            ->add('show_task_p1_delete_button', CheckboxType::class, [
                'label' => 'Bouton supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, 
                'data' => $options['show_task_p1_delete_button'],
            ])
            ->add('show_waiting_return_in_p1_cw', CheckboxType::class, [
                'label' => 'Bouton Attente Retour',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_waiting_return_in_p1_cw'],
            ]) 
            ->add('show_switch_to_cw', CheckboxType::class, [
                'label' => 'Basculer en semaine actuelle',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, 
                'data' => $options['show_switch_to_cw'], 
            ])
            ->add('show_p2_button_in_nw', CheckboxType::class, [
                'label' => 'Bouton P2',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_p2_button_in_nw'],
            ])
            ->add('show_task_p1_nw_to_p1_cw_button', CheckboxType::class, [
                'label' => 'Bouton P1 vers semaine actuelle',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_task_p1_nw_to_p1_cw_button'],
            ])
            ->add('show_task_p1_nw_modify_button', CheckboxType::class, [
                'label' => 'Bouton  modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_task_p1_nw_modify_button'],
            ])
            ->add('show_task_p1_nw_delete_button', CheckboxType::class, [
                'label' => 'Bouton supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_task_p1_nw_delete_button'],
            ])
            ->add('show_button_done_in_cw', CheckboxType::class, [
                'label' => 'Bouton "Fait""',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_button_done_in_cw'],
            ])
            ->add('show_button_done_in_nw', CheckboxType::class, [
                'label' => 'Bouton "Fait""',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_button_done_in_nw'],
            ])
            ->add('show_waiting_return_in_p1_nw', CheckboxType::class, [
                'label' => 'Bouton Attente Retour',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_waiting_return_in_p1_nw'],
            ])
            ->add('show_waiting_return_add', CheckboxType::class, [
                'label' => 'Bouton ajouter attente retour',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_waiting_return_add'],
            ])
            ->add('add_task_cw', CheckboxType::class, [
                'label' => 'Ajouter une tâche',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['add_task_cw'],
            ])
            ->add('reorder_task_cw', CheckboxType::class, [
                'label' => 'Trier les tâches',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['reorder_task_cw'],
            ])
            ->add('generate_archive_task', CheckboxType::class, [
                'label' => 'Générer l\'archive des tâches',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['generate_archive_task'],
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
            'show_p2_button_in_cw' => null,
            'show_task_p1_cw_to_p1_nw_button' => null,
            'show_task_p1_modify_button' => null,
            'show_task_p1_delete_button' => null,
            'show_waiting_return_in_p1_cw' => null,
            'show_switch_to_cw' => null,
            'show_p2_button_in_nw' => null,
            'show_waiting_return_in_p1_nw' => null,
            'show_task_p1_nw_to_p1_cw_button' => null,
            'show_task_p1_nw_modify_button' => null,
            'show_task_p1_nw_delete_button' => null,
            'show_button_done_in_cw' => null,
            'show_button_done_in_nw' => null,
            'reorder_task_cw' => null,
            'add_task_cw' => null,
            'generate_archive_task' => null,
            'show_waiting_return_add' => null
        ]);
    }
}