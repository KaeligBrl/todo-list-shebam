<?php

namespace App\Form\Back\Task2;

use App\Entity\User;
use App\Entity\Task2;
use App\Entity\Status;
use App\Entity\Statut;
use App\Form\UserMultipleType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\WeekType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\Customer;

class AdminTask2AddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('customer', EntityType::class, array(
            'required' => true,
            'label' => 'Client :',
            'class' => Customer::class,
            'label_attr' => ['class' => 'label-custom'],
        ))
        ->add('subject',  TextType::class, [
            'required' => true,
            'label' => false,
            'attr' => [
                'placeholder' => 'Sujet',
                'class' => ' form-control is-invalid'
            ]
        ])
        ->add('subsubject1',  TextType::class, [
            'required' => false,
            'label' => false,
            'attr' => [
                'placeholder' => 'Sous-Sujet 1',
                'class' => ' form-control is-invalid'
            ]
        ])
        ->add('subsubject2',  TextType::class, [
            'required' => false,
            'label' => false,
            'attr' => [
                'placeholder' => 'Sous-Sujet 2',
                'class' => ' form-control is-invalid'
            ]
        ])
        ->add('subsubject3',  TextType::class, [
            'required' => false,
            'label' => false,
            'attr' => [
                'placeholder' => 'Sous-Sujet 3',
                'class' => ' form-control is-invalid'
            ]
        ])
        ->add('users', EntityType::class, array(
            'required' => true,
            'label' => 'Personne(s) :',
            'class' => User::class,
            'multiple' => true,
            'expanded' => true,
            'label_attr' => ['class' => 'label-custom'],
        ))
        ->add('status', EntityType::class, array(
            'required' => true,
            'label' => 'Statut :',
            'class' => Status::class,
            'label_attr' => ['class' => 'label-custom'],
        ))
        ->add('comment', TextareaType::class, array(
            'required' => true,
            'label' => false,
            'attr' => ['placeholder' => 'Remarque'],
        ))
        ->add('submit', SubmitType::class, [
            'label' => 'Enregistrer',
            'attr' => ['class' => 'btn-submit-admin-shebam'],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task2::class,
        ]);
    }
}
