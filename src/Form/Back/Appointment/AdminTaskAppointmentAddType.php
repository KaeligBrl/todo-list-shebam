<?php

namespace App\Form\Back\Appointment;

use App\Entity\User;
use App\Entity\Status;
use App\Entity\Appointment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AdminTaskAppointmentAddType extends AbstractType
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
            'label' => 'Heure du rendez-vous :',
            'label_attr' => ['class' => 'label-custom'],
            'widget' => 'single_text',
            'minutes' => ['00', '15', '30', '45'],
        ])
        ->add('user', EntityType::class, array(
            'required' => true,
            'label' => 'Personne(s) :',
            'class' => User::class,
            'multiple' => true,
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
