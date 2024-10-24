<?php

// src/Form/Type/OptionDependencyType.php

namespace GriffePhotos\OptionDependencyPlugin\Form\Type;

use GriffePhotos\OptionDependencyPlugin\Entity\OptionDependencyInterface;
use App\Entity\Product\ProductOption;
use App\Entity\Product\ProductOptionValue;
use GriffePhotos\OptionDependencyPlugin\Validator\Constraints\ChildOptionHasDefaultValue;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class OptionDependencyType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentOption', EntityType::class, [
                'class' => ProductOption::class,
                'choice_label' => 'name',
                'label' => $this->translator->trans('griffephotos.ui.form.parent_option_label'),
                'placeholder' => $this->translator->trans('griffephotos.ui.form.parent_option_placeholder'),
                'constraints' => [
                    new NotBlank([
                        'message' => $this->translator->trans('griffephotos.ui.form.validation.parent_option_required'),
                    ]),
                ],
            ])
            ->add('parentOptionValue', EntityType::class, [
                'class' => ProductOptionValue::class,
                'choice_label' => 'value',
                'label' => $this->translator->trans('griffephotos.ui.form.parent_option_value_label'),
                'placeholder' => $this->translator->trans('griffephotos.ui.form.parent_option_value_placeholder'),
                'constraints' => [
                    new NotBlank([
                        'message' => $this->translator->trans('griffephotos.ui.form.validation.parent_option_value_required'),
                    ]),
                ],
            ])
            ->add('childOption', EntityType::class, [
                'class' => ProductOption::class,
                'choice_label' => 'name',
                'label' => $this->translator->trans('griffephotos.ui.form.child_option_label'),
                'placeholder' => $this->translator->trans('griffephotos.ui.form.child_option_placeholder'),
                'constraints' => [
                    new NotBlank([
                        'message' => $this->translator->trans('griffephotos.ui.form.validation.child_option_required'),
                    ]),
                    new ChildOptionHasDefaultValue(null, $this->translator->trans('griffephotos.ui.form.validation.child_option_has_default_value')),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OptionDependencyInterface::class,
        ]);
    }
}
