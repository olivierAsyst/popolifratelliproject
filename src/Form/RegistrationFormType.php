<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => false,
                'attr' =>[
                    'placeholder'=> "Entrer le nom complet",
                    'class' => 'flex-1'
                ],
                'row_attr'=>[
                    "class" => "form-group flex"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom est obligatoire',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le nom de passe doit depasse {{ limit }} characteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 100,
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' =>[
                    'placeholder'=> "L'adresse mail",
                    'class' => 'flex-1'
                ],
                'row_attr'=>[
                    "class" => "form-group flex"
                ]
            ])
            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'Accepte notre reglement.',
            //         ]),
            //     ],
            // ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mots de passe ne correspondent pas.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => false, 'attr' =>[
                    'placeholder'=> "Entrer le mot de passe",
                    'class'=> 'flex-1'
                ],
                'row_attr'=>[
                    "class" => "form-group flex"
                ]],
                'second_options' => ['label' => false, 'attr' =>[
                    'placeholder'=> "Confirmer le mot de passe",
                    'class' => 'flex-1'
                ],
                'row_attr'=>[
                    "class" => "form-group flex"
                ]],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer le mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mot de passe doit depasse {{ limit }} characteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 25,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
