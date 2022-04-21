<?php

namespace App\Form\Front\Task;

use App\Entity\Task;
use App\Entity\User;
use App\Entity\Customer;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ModifyTaskP2NextWeekType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer', EntityType::class, array(
                'required' => true,
                'label' => false,
                'class' => Customer::class,
                'label_attr' => ['class' => 'label-custom'],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                }
            ))
            ->add('object',  TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Objet',
                    'class' => ' form-control'
                ]
            ])
            ->add('subobject1',  TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Sous-Objet 1',
                    'class' => ' form-control'
                ]
            ])
            ->add('subobject2',  TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Sous-Objet 2',
                    'class' => ' form-control'
                ]
            ])
            ->add('subobject3',  TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Sous-Objet 3',
                    'class' => ' form-control'
                ]
            ])
            ->add('users', EntityType::class, array(
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
            ->add('p2',  CheckboxType::class, [
                'required' => false,
                'label' => 'Priorité 2',
                'label_attr' => ['class' => 'label-form mb-3'],
                'attr' => [
                    'checked'   => 'checked'
                ]
            ])
            ->add('nextweek',  CheckboxType::class, [
                'required' => false,
                'label' => 'Semaine Suivante',
                'label_attr' => ['class' => 'label-form'],
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
            'data_class' => Task::class,
        ]);
    }
}
