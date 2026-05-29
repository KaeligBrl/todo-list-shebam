<?php

namespace App\Form\Back\Role;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('role', TextType::class, [
                'label' => 'Nom du rôle (ex: ROLE_USER)',
                'label_attr' => ['class' => 'color-yellow text-bold mb-3'],
                'constraints' => [
                    new NotBlank(['message' => 'Le nom du rôle ne peut pas être vide']),
                    new Length([
                        'min' => 6,
                        'max' => 50,
                        'minMessage' => 'Le nom du rôle doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom du rôle ne peut pas dépasser {{ limit }} caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^ROLE_[A-Z0-9_]+$/',
                        'message' => 'Le rôle doit commencer par "ROLE_" et ne contenir que des majuscules, chiffres et tirets bas',
                    ]),
                ],
            ])
            ->add('label', TextType::class, [
                'label' => 'Description du rôle',
                'label_attr' => ['class' => 'color-yellow text-bold mb-3'],
                'constraints' => [
                    new NotBlank(['message' => 'La description du rôle ne peut pas être vide']),
                    new Length([
                        'min' => 3,
                        'max' => 100,
                        'minMessage' => 'La description doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'La description ne peut pas dépasser {{ limit }} caractères',
                    ]),
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
