<?php

namespace App\Form\Front\Quote;

use App\Entity\User;
use App\Entity\Quote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AddQuoteNextWeekType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Sujet',
                    'class' => ' form-control'
                ]
            ])
            ->add('object', TextType::class, [
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
                'expanded' => true,
                'multiple' => true,
                'label_attr' => ['class' => 'label-form'],
            ))
            ->add('nextweek',  CheckboxType::class, [
                'required' => false,
                'label' => 'Semaine Suivante',
                'label_attr' => ['class' => 'label-form mb-3'],
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quote::class,
        ]);
    }
}
