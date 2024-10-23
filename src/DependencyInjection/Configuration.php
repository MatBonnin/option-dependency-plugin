<?php

namespace GriffePhotos\OptionDependencyPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('griffe_photos_option_dependency_plugin');

        // Define the parameters that are allowed to configure your bundle here
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
