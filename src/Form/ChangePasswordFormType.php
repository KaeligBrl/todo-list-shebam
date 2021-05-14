<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => ShowHidePasswordType::class,
                'first_options' => [
                    'attr' => [
                    'placeholder' => 'Mon nouveau mot de passe'
                ],
                    // 'constraints' => [
                    //     new NotBlank([
                    //         'message' => 'Please enter a password',
                    //     ]),
                    //     new Length([
                    //         'min' => 6,
                    //         'minMessage' => 'Your password should be at least {{ limit }} characters',
                    //         // max length allowed by Symfony for security reasons
                    //         'max' => 4096,
                    //     ]),
                    // ],
                    'label' => 'Nouveau mot de passe',
                ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmation du nouveau mot de passe'
                    ],

                ],
                'invalid_message' => 'Les deux mots de passe ne sont pas identifiques',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn-blue-shebam mt-3 mb-2'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }}