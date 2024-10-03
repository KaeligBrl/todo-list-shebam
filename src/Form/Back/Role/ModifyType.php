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
                'label' => 'Bouton P2',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, 
                'data' => $options['p2_button_in_p1_cw'], 
            ])
            ->add('task_p1_cw_to_p1_nw_button', CheckboxType::class, [
                'label' => 'De P1 vers semaine suivante',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p1_cw_to_p1_nw_button'],
            ])
            ->add('task_p1_modify_button', CheckboxType::class, [
                'label' => 'Bouton modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p1_modify_button'], 
            ])
            ->add('task_p1_delete_button', CheckboxType::class, [
                'label' => 'Bouton supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false, 
                'data' => $options['task_p1_delete_button'],
            ])
            ->add('waiting_return_in_p1_cw', CheckboxType::class, [
                'label' => 'Bouton Attente Retour',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['waiting_return_in_p1_cw'],
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
            ->add('waiting_return_in_p2_cw', CheckboxType::class, [
                'label' => 'Bouton attente Retour',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['waiting_return_in_p2_cw'],
            ])
            ->add('task_p2_cw_to_p1_nw_button', CheckboxType::class, [
                'label' => 'De P2 vers semaine actuelle',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['task_p2_cw_to_p1_nw_button'],
            ])
            // Current Week -> Wainting Return
            ->add('wainting_return_to_p1', CheckboxType::class, [
                'label' => 'Vers P1',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['wainting_return_to_p1'],
            ])
            ->add('wainting_return_to_p2', CheckboxType::class, [
                'label' => 'Vers P2',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['wainting_return_to_p2'],
            ])
            ->add('wainting_return_from_cw_to_nw', CheckboxType::class, [
                'label' => 'Vers semaine suivante',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['wainting_return_from_cw_to_nw'],
            ])
            ->add('wainting_return_modify_cw', CheckboxType::class, [
                'label' => 'Bouton Modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['wainting_return_modify_cw'],
            ])
            ->add('wainting_return_delete_cw', CheckboxType::class, [
                'label' => 'Bouton Supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['wainting_return_delete_cw'],
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
            // Next WEEK -> P1
            ->add('waiting_return_in_p1_nw', CheckboxType::class, [
                'label' => 'Bouton Attente Retour',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['waiting_return_in_p1_nw'],
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
            // Next WEEK -> P2
            ->add('waiting_return_in_p2_nw', CheckboxType::class, [
                'label' => 'Bouton Attente Retour',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['waiting_return_in_p2_nw'],
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

            // Next WEEK -> Wainting Return
            ->add('wainting_return_nw_to_p1', CheckboxType::class, [
                'label' => 'Vers P1',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['wainting_return_nw_to_p1'],
            ])
            ->add('wainting_return_nw_to_p2', CheckboxType::class, [
                'label' => 'Vers P2',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['wainting_return_nw_to_p2'],
            ])
            ->add('wainting_return_nw_to_cw', CheckboxType::class, [
                'label' => 'Vers semaine actuelle',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['wainting_return_nw_to_cw'],
            ])
            ->add('wainting_return_modify_nw', CheckboxType::class, [
                'label' => 'Bouton modifier',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['wainting_return_modify_nw'],
            ])
            ->add('wainting_return_delete_nw', CheckboxType::class, [
                'label' => 'Bouton supprimer',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['wainting_return_delete_nw'],
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
            // Global
            ->add('button_done', CheckboxType::class, [
                'label' => 'Bouton "Fait"',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['button_done'],
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
            ->add('add_wainting_return', CheckboxType::class, [
                'label' => 'Ajouter une attente retour',
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'required' => false,
                'data' => $options['add_wainting_return'],
            ])
            // Urls
            
            ->add('submit', SubmitType::class, [
                'label' => 'Mettre à jour',
                'attr' => ['class' => 'btn-yellow-form mt-2 text-bold'],
            ]);

        foreach ($routes as $route) {
            // Vérifiez le nom de la route
            $routeName = $route['name']; // Cela dépend de la structure de $route
            $checkboxName = $routeName; // Nom de la case à cocher

            $status = $route['status'];

            $builder->add($checkboxName, CheckboxType::class, [
                'label' => $routeName,
                'label_attr' => ['class' => 'color-yellow text-bold'],
                'attr' => ['checked' => $status],
                'required' => false
            ]);
        }

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'role' => null, 
            'label' => null,
            // Current WEEK -> P1
            'p2_button_in_p1_cw' => null,
            'task_p1_cw_to_p1_nw_button' => null,
            'task_p1_modify_button' => null,
            'task_p1_delete_button' => null,
            'waiting_return_in_p1_cw' => null,
            'task_p1_nw_modify_button' => null,
            // Current Week -> P2
            'p1_button_in_p2_cw' => null,
            'task_p2_modify_button' => null,
            'task_p2_delete_button' => null,
            'waiting_return_in_p2_cw' => null,
            'task_p2_cw_to_p1_nw_button' => null,
            // Current Week -> Wainting Return
            'wainting_return_to_p1' => null,
            'wainting_return_to_p2' => null,
            'wainting_return_from_cw_to_nw' => null,
            'wainting_return_modify_cw' => null,
            'wainting_return_delete_cw' => null,
            // Current Week -> Appointment
            'appointment_cw_to_nw' => null,
            'appointment_modify_cw'=> null,
            'appointment_delete_cw' => null,
            // Next WEEK -> P1
            'waiting_return_in_p1_nw' => null,
            'task_p1_nw_to_p1_cw_button' => null,
            'task_p1_to_p2_nw' => null,
            'task_p1_modify_nw' => null,
            'task_p1_delete_nw' => null,
            // Next WEEK -> P2
            'task_p2_to_p1_nw' => null,
            'task_p2_modify_nw' => null,
            'task_p2_delete_nw' => null,
            'task_p2_nw_to_p2_cw_button' => null,
            'waiting_return_in_p2_nw' => null,
            // Next WEEK -> Wainting Return
            'wainting_return_nw_to_p1' => null,
            'wainting_return_nw_to_p2' => null,
            'wainting_return_nw_to_cw' => null,
            'wainting_return_modify_nw' => null,
            'wainting_return_delete_nw' => null,
            'appointment_nw_to_cw' => null,
            'appointment_modify_nw' => null,
            'appointment_delete_nw' => null,
            // Global
            'reorder_task' => null,
            'add_task' => null,
            'generate_archive_task' => null,
            'button_done' => null,
            'add_wainting_return' => null,
            'routes' => []
        ]);
    }
}