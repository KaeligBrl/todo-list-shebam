<?php

namespace App\Form\Front\Appointment;

use App\Entity\User;
use App\Entity\Appointment;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use App\Form\Front\Conditions\SelectedUsers;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ModifyAppointmentNextWeekType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',  TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Intitulé du rendez-vous',
                    'class' => ' form-control'
                ]
            ])
            ->add('subject',  TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Sujet',
                    'class' => ' form-control'
                ]
            ])
            ->add('hoursappointment', DateTimeType::class, [
                'label' => 'Heure du rendez-vous :',
                'label_attr' => ['class' => 'label-form'],
                'days' => range(1, 31),
                'years' => range(2021, 2022),
                'hours' => range(7, 18),
                'widget' => 'single_text',
            ])
            ->add('user', EntityType::class, array(
                'required' => true,
                'label' => false,
                'expanded' => true,
                'class' => User::class,
                'constraints' => [
                    new NotBlank(),
                    new SelectedUsers(),
                ],
                'multiple' => true,
                'label_attr' => ['class' => 'label-form'],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.firstname', 'ASC');
                }
            ))
            ->add('nextweek',  CheckboxType::class, [
                'required' => false,
                'label' => 'Semaine Suivante',
                'label_attr' => ['class' => 'color-yellow mb-3'],
                'attr' => [
                    'placeholder' => 'Semaine Suivante',
                    'checked'   => 'checked'                    
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => ['class' => 'btn-yellow-form text-bold text-20'],
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
