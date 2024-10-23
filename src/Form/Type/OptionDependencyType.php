<?php

namespace GriffePhotos\OptionDependencyPlugin\Form\Type;

use GriffePhotos\OptionDependencyPlugin\Entity\OptionDependencyInterface;
use App\Entity\Product\ProductOption;
use App\Entity\Product\ProductOptionValue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OptionDependencyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentOption', EntityType::class, [
                'class' => ProductOption::class,
                'choice_label' => 'name',
                'label' => 'Option Parent',
                'placeholder' => 'Choisissez une option parent',
            ])
            ->add('parentOptionValue', EntityType::class, [
                'class' => ProductOptionValue::class,
                'choice_label' => 'value',
                'label' => 'Valeur de l\'Option Parent',
                'placeholder' => 'Choisissez une valeur',
            ])
            ->add('childOption', EntityType::class, [
                'class' => ProductOption::class,
                'choice_label' => 'name',
                'label' => 'Option Enfant',
                'placeholder' => 'Choisissez une option enfant',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OptionDependencyInterface::class,
        ]);
    }
}
