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
use Symfony\Bundle\SecurityBundle\Security;

class CustomOrderTypeForm extends AbstractType
{
    public function __construct(
        private Security $security
    ) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'attr' => [
                    'class' => 'flex',
                    'placeholder' => 'exemple@email.com',
                    'autocomplete' => 'off',
                    'value' => $this->security->getUser()->getEmail(),
                ],
            ])
            ->add('message')
            ->add('length', ChoiceType::class, [
                'choices' => [
                    'Selectionner une longueur' => null,
                    '50 cm' => 50,
                    '80 cm' => 80,
                    '100 cm' => 100,
                    '120 cm' => 120,
                    '150 cm' => 150,
                    '180 cm' => 180,
                    '200 cm' => 200,
                    '250 cm' => 250,
                    '300 cm' => 300,
                ]
            ])
            ->add('width', ChoiceType::class, [
                'choices' => [
                    'Selectionner une largeur' => null,
                    '10 cm' => 10,
                    '20 cm' => 20,
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
