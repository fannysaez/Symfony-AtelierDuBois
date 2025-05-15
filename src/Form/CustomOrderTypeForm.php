<?php

namespace App\Form;

use App\Entity\Material;
use App\Entity\WoodType;
use App\Entity\CustomOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CustomOrderTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'flex',
                ],
            ])
            ->add('message')
            ->add('length', ChoiceType::class, [
                'choices' => [
                    'Selectionner une longueur' => null,
                    '60 cm' => 60,
                    '80 cm' => 80,
                    '100 cm' => 100
                ]
            ])
            ->add('width', ChoiceType::class, [
                'choices' => [
                    'Selectionner une largeur' => null,
                    '30 cm' => 30,
                    '40 cm' => 40,
                    '50 cm' => 50
                ]
            ])
             ->add('material', EntityType::class, [
                'class' => Material::class,
                'choice_label' => 'name'
            ])
             ->add('woodType', EntityType::class, [
                'class' => WoodType::class,
                'choice_label' => 'name',
            ])
            
            // ->add('createdAt')
           
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomOrder::class,
        ]);
    }
}
