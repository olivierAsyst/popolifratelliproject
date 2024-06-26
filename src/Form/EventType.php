<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startDate', DateType::class, [
                'label' => 'Date debut',
                'placeholder' => ['year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                'hour' => 'H', 'minute' => 'M', 'second' => 'S'],
                'input_format' => 'd/m/Y H:i:s'
            ])
            ->add('endDate', DateType::class, [
                'label' => "Date fin (N'est pas obligatoire)",
                'placeholder' => ['year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                'hour' => 'H', 'minute' => 'M', 'second' => 'S'],
                'input_format' => 'd/m/Y H:i:s',
                'required' => false
            ])
            ->add('title', TextType::class, [
                'label' => false,
                'attr' =>[
                    'placeholder' => "Titre du programme ou Evenement",
                    'class'=>'flex-1'
                ],
                'row_attr'=>[
                    'class'=>"form-group flex"
                ]
            ])
            ->add('content', TextareaType::class, [
                'label'=>false,
                'required'=>false,
                'attr'=>[
                    'placeholder' => "Contenu du programme ou Evenement",
                    'rows'=>15,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
