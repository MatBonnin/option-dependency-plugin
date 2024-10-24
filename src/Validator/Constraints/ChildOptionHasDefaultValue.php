<?php

namespace GriffePhotos\OptionDependencyPlugin\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Annotation
 */
class ChildOptionHasDefaultValue extends Constraint
{
    public $message;

    public function __construct($options = null, String $message)
    {
        parent::__construct($options);
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
