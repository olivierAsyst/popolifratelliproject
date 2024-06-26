<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class,[
                'label' => false,
                'attr' =>[
                    'placeholder' => "Nom complet du membre",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
            ->add('fonction', TextType::class,[
                'label' => false,
                'attr' =>[
                    'placeholder' => "Fonction du membre",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'required'=>false,
                'attr' =>[
                    'placeholder' => "Sa petite description",
                    'rows'=>15,
                ]
            ])
            ->add('social_linkOne', TextType::class,[
                'required'=>false,
                'label' => false,
                'attr' =>[
                    'placeholder' => "Lien facebook",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
            ->add('social_linkTwo', TextType::class,[
                'required'=>false,
                'label' => false,
                'attr' =>[
                    'placeholder' => "Lien Twitter",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
            ->add('social_linkThree', TextType::class,[
                'required'=>false,
                'label' => false,
                'attr' =>[
                    'placeholder' => "Lien linkedin",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
            ->add('imageFile', FileType::class, [
                'label' => false,
                'required' => false,
                'row_attr'=>['class'=>'form-group flex'],
                'attr' =>[
                    'class'=>'flex-1'
                ],
                'constraints' => [
                    new File ([
                        'maxSize' => '10M',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} {{ suffix }}). La taille maximale autorisée est de {{ limit }} {{ suffix }}',
                        'extensions' => [
                            'jpg',
                            'png',
                            'gif',
                            'webp'
                        ],
                        'mimeTypesMessage' => "Seul, les images sont permis",
                    ]),
                    new NotBlank([
                        'message' => 'L\'image est recquise',
                    ]),
                ]
            ])
            ->add('dateJoined', DateType::class, [
                'label' => 'A rejoint le',
                'required'=>false,
                'placeholder' => ['year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                ],
                'input_format' => 'd/m/Y'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
