<?php

namespace App\Form\Back;

use App\Entity\User;
use App\Entity\Status;
use App\Entity\Rendezvous;
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
            ->add('sujet',  TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Sujet',
                    'class' => ' form-control is-invalid'
                ]
            ])
            ->add('heuredurendezvous', DateTimeType::class, [
                'label' => 'Heure du rendez-vous ',
                'label_attr' => ['class' => 'label-custom'],
                'days' => range(1,31),
                'years' => range(2021,2023),
                'hours' => range(7,18),
                'placeholder' => ['january' => 'janvier'],
            ])
            ->add('utilisateur', EntityType::class, array(
                'required' => true,
                'label' => 'Personne(s) Désigné(e): ',
                'class' => User::class,
                'multiple' => true,
                'expanded' => true,
                'label_attr' => ['class' => 'label-custom'],
            ))
            ->add('statut', EntityType::class, array(
                'required' => true,
                'label' => 'Statut :',
                'class' => Status::class,
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
            'data_class' => Rendezvous::class,
        ]);
    }
}
