<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,
                [
                    'label' => 'Nom',
                    'attr' => [
                        'class' => 'mt-3',
                        'type' => 'text',
                        'autocomplete' => 'off',
                        'placeholder' => '3 caractères minimum',
                    ],
                    'row_attr' => [
                        'class' => 'input-group'
                    ],
                    'constraints' =>
                        new Length([
                            'max' => 24
                        ]),
                ])
            ->add('email', EmailType::class, [

                'label' => 'Email',
                'attr' => [
                    'class' => 'mt-3',
                    'type' => 'text',
                    'autocomplete' => 'off',
                    'placeholder' => 'Votre email',
                ],
                'row_attr' => [
                    'class' => 'input-group'
                ],
                'constraints' => new Length
                (
                    [
                        'min' => 15,
                        'max' => 60,
                    ]
                ),

            ])
            ->add('password', PasswordType::class, [
                'label' => 'Votre mot de passe',
                'constraints' => new Length
                (
                    [
                        'min' => 2,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères.',
                        'max' => 60,
                    ]
                ),
                'attr' => [
                    'class' => 'form-control-lg'
                ],
                'required' => true,

            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' =>
                    [
                        'label' => 'Mot de passe',
                        'attr' =>
                            [
                                'placeholder' => 'Merci de saisir votre mot de passe',
                            ],
                    ],
                'second_options' =>
                    [
                        'label' => 'Confirmez votre mot de passe',
                        'attr' =>
                            [
                                'placeholder' => 'Merci de confirmer votre  mot de passe',
                            ],
                    ],
            ])
            ->add('submit',SubmitType::class,
            [
                'label'=> 'S\'inscrire'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
