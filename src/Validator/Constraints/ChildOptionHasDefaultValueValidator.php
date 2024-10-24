<?php

// src/Validator/Constraints/ChildOptionHasDefaultValueValidator.php

namespace GriffePhotos\OptionDependencyPlugin\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Sylius\Component\Product\Model\ProductOptionInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class ChildOptionHasDefaultValueValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ChildOptionHasDefaultValue) {
            throw new UnexpectedTypeException($constraint, ChildOptionHasDefaultValue::class);
        }

        if (null === $value) {
            return;
        }

        if (!$value instanceof ProductOptionInterface) {
            throw new UnexpectedValueException($value, ProductOptionInterface::class);
        }

        // Récupérer les valeurs de l'option enfant
        $optionValues = $value->getValues();

        // Vérifier si au moins une valeur d'option a un code commençant par "default"
        $hasDefaultValue = false;

        foreach ($optionValues as $optionValue) {
            if (strpos($optionValue->getCode(), 'default') === 0) {
                $hasDefaultValue = true;
                break;
            }
        }

        if (!$hasDefaultValue) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ optionName }}', $value->getName())
                ->addViolation();
        }
    }
}
