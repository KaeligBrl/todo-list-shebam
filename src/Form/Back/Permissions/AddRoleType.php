<?php

namespace App\Form\Back\Permission;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('role', TextType::class, [
                'label' => 'Nom du rôle (ex: ROLE_USER)',
                'label_attr' => ['class' => 'color-yellow text-bold mb-3'],
                'constraints' => [
                    new NotBlank(['message' => 'Le rôle ne peut pas être vide']),
                ],
            ])
            ->add('label', TextType::class, [
                'label' => 'Description du rôle',
                'label_attr' => ['class' => 'color-yellow text-bold mb-3'],
                'constraints' => [
                    new NotBlank(['message' => 'Le label ne peut pas être vide']),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => ['class' => 'btn-yellow-form mt-2 text-bold'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure options if needed
        ]);
    }
}
