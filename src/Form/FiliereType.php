<?php

namespace App\Form;

use App\Entity\Filiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class FiliereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' =>[
                    'placeholder' => "Nom de l'activité",
                    'class'=>'flex-1'
                ],
                'row_attr'=>[
                    'class'=>"form-group flex"
                ]
            ])
            ->add('description', TextareaType::class, [
                'label'=>false,
                'required'=>false,
                'attr'=>[
                    'placeholder' => "Description de l'activité",
                    'rows'=>15,
                ],
            ])
            ->add('imageFile', FileType::class, [
                'label' => false,
                'required' => false,
                'row_attr'=>['class'=>'form-group flex'],
                'attr' =>[
                    'class'=>'flex-1'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'L\image de l\'activité est recquise',
                    ]),
                    new File([
                        'maxSize' => '5M',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} {{ suffix }}). La taille maximale autorisée est de {{ limit }} {{ suffix }}',
                        'extensions' => [
                            'jpg',
                            'png',
                            'webp',
                            'avif'
                        ],
                        'mimeTypesMessage' => "Seul, les images sont permis",
                    ])],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Filiere::class,
        ]);
    }
}
