<?php

namespace App\Form;

use App\Entity\CustomOrder;
use App\Entity\Material;
use App\Entity\WoodType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomOrderTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('message')
            ->add('length')
            ->add('width')
             ->add('material', EntityType::class, [
                'class' => Material::class,
                'choice_label' => 'id',
            ])
             ->add('woodType', EntityType::class, [
                'class' => WoodType::class,
                'choice_label' => 'id',
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
