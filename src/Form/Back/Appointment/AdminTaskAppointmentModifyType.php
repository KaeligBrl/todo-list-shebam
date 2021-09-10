<?php

namespace App\Form\Back\Appointment;

use App\Entity\User;

use App\Entity\Appointment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AdminTaskAppointmentModifyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',  TextType::class, [
            'required' => true,
            'label' => false,
            'attr' => [
                'placeholder' => 'Intitulé du rendez-vous',
                'class' => ' form-control is-invalid'
            ]
        ])
            ->add('subject',  TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Sujet',
                    'class' => ' form-control is-invalid'
                ]
            ])
            ->add('hoursappointment', DateTimeType::class, [
                'label' => 'Heure du rendez-vous ',
                'label_attr' => ['class' => 'label-custom'],
                'days' => range(1,31),
                'years' => range(2021,2023),
                'hours' => range(7,18),
                'widget' => 'single_text',
            ])
            ->add('user', EntityType::class, array(
                'required' => true,
                'label' => 'Personne(s) Désigné(e): ',
                'multiple' => true,
                'class' => User::class,

                'expanded' => true,
                'label_attr' => ['class' => 'label-custom'],
            ))
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn-submit-admin-shebam'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
