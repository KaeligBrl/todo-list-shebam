<?php

namespace App\Form\Front\Appointment;

use App\Entity\User;
use App\Entity\Appointment;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AddAppointmentCurrentWeekType extends AbstractType
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
            'days' => range(1,31),
            'years' => range(2021,2022),
            'hours' => range(7,18),
            'widget' => 'single_text',
        ])
        ->add('user', EntityType::class, array(
            'required' => true,
            'label' => false,
            'class' => User::class,
            'multiple' => true,
            'expanded' => true,
            'label_attr' => ['class' => 'label-form'],
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.firstname', 'ASC');
            }
        ))
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
