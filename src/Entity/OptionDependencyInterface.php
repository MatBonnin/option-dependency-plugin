<?php

namespace GriffePhotos\OptionDependencyPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Product\Model\ProductOptionInterface;
use Sylius\Component\Product\Model\ProductOptionValueInterface;

interface OptionDependencyInterface extends ResourceInterface
{
    public function getId(): ?int;

    public function getParentOption(): ?ProductOptionInterface;

    public function setParentOption(ProductOptionInterface $parentOption): void;

    public function getParentOptionValue(): ?ProductOptionValueInterface;

    public function setParentOptionValue(ProductOptionValueInterface $parentOptionValue): void;

    public function getChildOption(): ?ProductOptionInterface;

    public function setChildOption(ProductOptionInterface $childOption): void;
}
