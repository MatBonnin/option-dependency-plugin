<?php

namespace GriffePhotos\OptionDependencyPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;
use GriffePhotos\OptionDependencyPlugin\Entity\OptionDependencyInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Product\Model\ProductOptionInterface;
use Sylius\Component\Product\Model\ProductOptionValueInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="GriffePhotos_option_dependency")
 */
class OptionDependency implements OptionDependencyInterface
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ProductOptionInterface::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $parentOption;

    /**
     * @ORM\ManyToOne(targetEntity=ProductOptionValueInterface::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $parentOptionValue;

    /**
     * @ORM\ManyToOne(targetEntity=ProductOptionInterface::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $childOption;

    // Implémentation des méthodes de l'interface

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentOption(): ?ProductOptionInterface
    {
        return $this->parentOption;
    }

    public function setParentOption(ProductOptionInterface $parentOption): void
    {
        $this->parentOption = $parentOption;
    }

    public function getParentOptionValue(): ?ProductOptionValueInterface
    {
        return $this->parentOptionValue;
    }

    public function setParentOptionValue(ProductOptionValueInterface $parentOptionValue): void
    {
        $this->parentOptionValue = $parentOptionValue;
    }

    public function getChildOption(): ?ProductOptionInterface
    {
        return $this->childOption;
    }

    public function setChildOption(ProductOptionInterface $childOption): void
    {
        $this->childOption = $childOption;
    }
}
