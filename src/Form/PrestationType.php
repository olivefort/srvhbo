<?php

namespace App\Form;

use App\Entity\Prestation;
use Symfony\Component\Form\AbstractType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class,[
                'attr' => [
                    'class' => 'block',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Titre',
                'label_attr' => [
                    'class' => 'block'
                ],
                'constraints' => [
                    new Assert\Length(['min'=>2,'max'=>50]),
                    new Assert\NotBlank()                    
                ]
            ])
            ->add('location', TextType::class, [
                'attr' => [
                    'class' => 'block',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Ville',
                'label_attr' => [
                    'class' => 'block'
                ],
                'constraints' => [
                    new Assert\Length(['min'=>2,'max'=>50]),
                    new Assert\NotBlank()                    
                ]
            ])
            ->add('date', DateType::class, [
                "input" => "datetime_immutable",
                'widget' => 'single_text',
                'label' => 'Jour'
            ])
            ->add('meetingLocation', TextType::class, [
                'attr' => [
                    'class' => 'block',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Lieu de rendez-vous',
                'label_attr' => [
                    'class' => 'block'
                ],
                'constraints' => [
                    new Assert\Length(['min'=>2,'max'=>50]),
                    new Assert\NotBlank()                    
                ]
            ])
            ->add('meetingHour', TimeType::class, [
                'input'  => 'datetime_immutable',
                'widget' => 'choice',
                'label' => 'Heure de rendez-vous',
            ])
            ->add('information', TextareaType::class, [
                'attr' => [
                    'class' => 'block',                    
                ],
                'label' => 'Informations',
                'label_attr' => [
                    'class' => 'block'
                ],
                'constraints' => [                    
                    new Assert\NotBlank()                    
                ]
            ])
            ->add('playingTime', TimeType::class, [
                'input'  => 'datetime_immutable',
                'widget' => 'choice',
                // 'choices' => [
                //     '30min' => '30min',
                //     '1heure' => '20min',
                //     '1h30min' => '35min',
                // ],
                'label' => 'Temps de jeu Total',
            ])
            ->add('nbPerformance', IntegerType::class, [
                'attr' => [
                    'class' => 'block',
                    'min' => 1,
                    'max' => 10
                ],
                'required' => false,
                'label' => 'Nombre de Passages',
                'label_attr' => [
                    'class' => 'block'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\LessThan(11)                    
                ]
            ])
            ->add('submit', SubmitType::class, 
            [
                'attr' => [
                    'class' => 'btn',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
