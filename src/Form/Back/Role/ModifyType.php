<?php

namespace App\Form\Back\Role;

use App\Service\RouteService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ModifyType extends AbstractType
{
    private RouteService $routeService;

    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $routes = $this->routeService->getRoutesFromControllers();

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
            // Current WEEK -> P1
            ->add('p2_button_in_p1_cw', CheckboxType::class, [
                'label' => $options['p2_button_in_p1_cw_label'] ?? 'Bouton P2',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, 
                'data' => $options['p2_button_in_p1_cw'], 
            ])
            ->add('add_task_cw', CheckboxType::class, [
                'label' => $options['add_task_cw_label'] ?? 'Ajouter une tâche',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['add_task_cw'],
            ])
            ->add('task_p1_cw_to_p1_nw_button', CheckboxType::class, [
                'label' => $options['task_p1_cw_to_p1_nw_button_label'] ?? 'De P1 vers semaine suivante',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p1_cw_to_p1_nw_button'],
            ])
            ->add('task_p1_modify_button', CheckboxType::class, [
                'label' => $options['task_p1_modify_button_label'] ?? 'Bouton modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p1_modify_button'], 
            ])
            ->add('task_p1_delete_button', CheckboxType::class, [
                'label' => $options['task_p1_delete_button_label'] ?? 'Bouton supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, 
                'data' => $options['task_p1_delete_button'],
            ])
            // Current Week -> P2
            ->add('p1_button_in_p2_cw', CheckboxType::class, [
                'label' => 'Bouton P1',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['p1_button_in_p2_cw'],
            ])
            ->add('task_p2_modify_button', CheckboxType::class, [
                'label' => 'Bouton modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p2_modify_button'],
            ])
            ->add('task_p2_delete_button', CheckboxType::class, [
                'label' => 'Bouton supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p2_delete_button'],
            ])

            ->add('task_p2_cw_to_p1_nw_button', CheckboxType::class, [
                'label' => 'De P2 vers semaine actuelle',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p2_cw_to_p1_nw_button'],
            ])
            // Current Week -> Appointment
            ->add('appointment_cw_to_nw', CheckboxType::class, [
                'label' => 'Vers semaine suivante',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['appointment_cw_to_nw'],
            ])
            ->add('appointment_modify_cw', CheckboxType::class, [
                'label' => 'Bouton modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['appointment_modify_cw'],
            ])
            ->add('appointment_delete_cw', CheckboxType::class, [
                'label' => 'Bouton supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['appointment_delete_cw'],
            ])
            ->add('task_p1_to_p2_nw', CheckboxType::class, [
                'label' => 'Bouton P2',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p1_to_p2_nw'],
            ])
            ->add('task_p1_nw_to_p1_cw_button', CheckboxType::class, [
                'label' => 'De P1 vers semaine actuelle',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p1_nw_to_p1_cw_button'],
            ])
            ->add('task_p1_modify_nw', CheckboxType::class, [
                'label' => 'Bouton Modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p1_modify_nw'],
            ])
            ->add('task_p1_delete_nw', CheckboxType::class, [
                'label' => 'Bouton Supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p1_delete_nw'],
            ])

            ->add('task_p2_to_p1_nw', CheckboxType::class, [
                'label' => 'Bouton P1',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p2_to_p1_nw'],
            ])
            ->add('task_p2_modify_nw', CheckboxType::class, [
                'label' => 'Bouton Modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p2_modify_nw'],
            ])
            ->add('task_p2_delete_nw', CheckboxType::class, [
                'label' => 'Bouton Supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p2_delete_nw'],
            ])
            ->add('task_p2_nw_to_p2_cw_button', CheckboxType::class, [
                'label' => 'De P2 vers semaine actuelle',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p2_nw_to_p2_cw_button'],
            ])

            // Current Week -> Appointment
            ->add('appointment_nw_to_cw', CheckboxType::class, [
                'label' => 'Vers semaine suivante',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['appointment_nw_to_cw'],
            ])
            ->add('appointment_modify_nw', CheckboxType::class, [
                'label' => 'Bouton modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['appointment_modify_nw'],
            ])
            ->add('appointment_delete_nw', CheckboxType::class, [
                'label' => 'Bouton supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['appointment_delete_nw'],
            ])
            ->add('add_task', CheckboxType::class, [
                'label' => 'Ajouter une tâche',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['add_task'],
            ])
            ->add('reorder_task', CheckboxType::class, [
                'label' => 'Trier les tâches',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['reorder_task'],
            ])
            ->add('generate_archive_task', CheckboxType::class, [
                'label' => 'Générer l\'archive des tâches',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['generate_archive_task'],
            ])
            ->add('show_switch_to_cw', CheckboxType::class, [
                'label' => 'Basculer vers semaine actuelle',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['show_switch_to_cw'],
            ])

            // Ideabam
            ->add('add_ideabam', CheckboxType::class, [
                'label' => 'Ajouter une idée',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['add_ideabam'],
            ])
            ->add('modify_ideabam', CheckboxType::class, [
                'label' => 'Bouton modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['modify_ideabam'],
            ])
            ->add('delete_ideabam', CheckboxType::class, [
                'label' => $options['delete_ideabam_label'] ?? 'Bouton supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['delete_ideabam'],
            ]);

        // Ajout dynamique de chaque route trouvée
        foreach ($routes as $route) {
            $routeName = $route['name'];
            $status = $route['status'];
            $builder->add($routeName, CheckboxType::class, [
                'label' => '' . str_replace('_', ' ', $routeName),
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'attr' => ['checked' => $status],
                'required' => false
            ]);
        }

        $builder->add('submit', SubmitType::class, [
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
            // Current WEEK -> P1
            'add_task_cw' => null,
            'p2_button_in_p1_cw' => null,
            'task_p1_cw_to_p1_nw_button' => null,
            'task_p1_modify_button' => null,
            'task_p1_delete_button' => null,
            'task_p1_nw_modify_button' => null,
            // Current Week -> P2
            'p1_button_in_p2_cw' => null,
            'task_p2_modify_button' => null,
            'task_p2_delete_button' => null,
            'task_p2_cw_to_p1_nw_button' => null,

            // Current Week -> Appointment
            'appointment_cw_to_nw' => null,
            'appointment_modify_cw'=> null,
            'appointment_delete_cw' => null,
            // Next WEEK -> P1
            'task_p1_nw_to_p1_cw_button' => null,
            'task_p1_to_p2_nw' => null,
            'task_p1_modify_nw' => null,
            'task_p1_delete_nw' => null,
            // Next WEEK -> P2
            'task_p2_to_p1_nw' => null,
            'task_p2_modify_nw' => null,
            'task_p2_delete_nw' => null,
            'task_p2_nw_to_p2_cw_button' => null,
            'appointment_nw_to_cw' => null,
            'appointment_modify_nw' => null,
            'appointment_delete_nw' => null,
            // Global
            'reorder_task' => null,
            'add_task' => null,
            'generate_archive_task' => null,
            'button_done' => null,
            'show_switch_to_cw' => null,
            'routes' => [],
            //Ideabam
            'add_ideabam' => null,
            'modify_ideabam' => null,
            'delete_ideabam' => null,
        ]);
    }
}