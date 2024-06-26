<?php

namespace App\Form;

use App\Entity\Filiere;
use App\Entity\StudentBook;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class StudentBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('studentFullName', TextType::class, [
                'label' => false,
                'attr' =>[
                    'placeholder' => "Titre de realisation",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
            ->add('title', TextType::class, [
                'label' => false,
                'attr' =>[
                    'placeholder' => "Lieu",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'required'=>false,
                'attr' =>[
                    'placeholder' => "Petite description sur ce travail",
                    "class" => "flex-1",
                    'rows'=>10,
                ],
                "row_attr" => [
                    "class" => "form-group flex"
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez une petite description de cette realisation',
                    ]),
                    new Length([
                        'max' => 500,
                        'maxMessage' => 'La description ne doit pas etre inferieur a {{ limit }} characteres',
                    ]),
                ]
            ])
            ->add('pdfFile', FileType::class, [
                'label' => false,
                'required' => false,
                'row_attr'=>['class'=>'form-group flex'],
                'attr' =>[
                    'class'=>'flex-1'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'L\'image est recquis',
                    ]),
                    new File([
                        'maxSize' => '15M',
                        'maxSizeMessage' => 'Le fichier est trop volumineux ({{ size }} {{ suffix }}). La taille maximale autorisée est de {{ limit }} {{ suffix }}',
                        'extensions' => [
                            'jpg',
                            'png',
                            'jpeg',
                            'webp',
                            'avif'
                        ],
                        'extensionsMessage' => "Seul, les fichiers jpg, jpeg et png sont permis",
                    ])],
            ])
            ->add('year', DateType::class, [
                'format' => 'dd/MM/yyyy',
                'label' => 'Année',
                'attr' =>[
                    'placeholder' => "Nom complet de l'Etudiant ou Professeur",
                    'class'=>'flex-1'
                ],
                'row_attr'=>['class'=>"form-group flex"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StudentBook::class,
        ]);
    }
}
