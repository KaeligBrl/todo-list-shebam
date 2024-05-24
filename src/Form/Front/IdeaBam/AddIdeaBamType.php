<?php

namespace App\Form\Front\IdeaBam;

use App\Entity\IdeaBam;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use App\Form\Front\Conditions\SelectedUsers;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AddIdeaBamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('subject',  TextType::class, [
            'required' => true,
            'label' => false,
            'attr' => [
                'placeholder' => 'Objet',
                'class' => ' form-control'
            ]
        ])
        ->add('person', EntityType::class, array(
            'required' => true,
            'label' => false,
            'class' => User::class,
            'constraints' => [
                new NotBlank(),
                new SelectedUsers(),
            ],
            'expanded' => true,
            'multiple' => true,
            'label_attr' => ['class' => 'label-form'],
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->orderBy('u.firstname', 'ASC');
            }
        ))
        ->add('date', DateTimeType::class, [
            'label' => 'Date de l\'évènement :',
            'label_attr' => ['class' => 'label-form'],
            'days' => range(1, 31),
            'hours' => range(7, 18),
            'widget' => 'single_text',
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Enregistrer',
            'attr' => ['class' => 'btn-yellow-form text-bold text-20'],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IdeaBam::class,
        ]);
    }
}
