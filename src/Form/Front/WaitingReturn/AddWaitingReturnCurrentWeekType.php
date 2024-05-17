<?php

namespace App\Form\Front\WaitingReturn;

use App\Entity\User;
use App\Entity\Customer;
use App\Entity\WaitingReturn;
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

class AddWaitingReturnCurrentWeekType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer', EntityType::class, array(
                'required' => true,
                'label' => false,
                'class' => Customer::class,
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
            ->add('users', EntityType::class, array(
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
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => ['class' => 'btn-yellow-form text-bold text-20'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WaitingReturn::class,
        ]);
    }
}
