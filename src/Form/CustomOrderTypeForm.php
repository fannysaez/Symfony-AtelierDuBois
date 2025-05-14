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
