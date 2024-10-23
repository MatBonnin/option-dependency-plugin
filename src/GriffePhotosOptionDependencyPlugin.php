<?php

// src/GriffePhotosOptionDependencyPlugin.php

namespace GriffePhotos\OptionDependencyPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class GriffePhotosOptionDependencyPlugin extends Bundle
{
    use SyliusPluginTrait;

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function getContainerExtension(): ?\Symfony\Component\DependencyInjection\Extension\ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new DependencyInjection\GriffePhotosOptionDependencyPluginExtension();
        }

        return $this->extension;
    }
}
