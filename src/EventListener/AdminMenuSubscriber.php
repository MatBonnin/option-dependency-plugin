<?php

namespace GriffePhotos\OptionDependencyPlugin\EventListener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuSubscriber
{
    public function addOptionDependencyMenu(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $catalogMenu = $menu->getChild('catalog');

        if (null === $catalogMenu) {
            $catalogMenu = $menu->addChild('catalog')->setLabel('sylius.menu.admin.main.catalog.header');
        }

        $catalogMenu
            ->addChild(
                'option_dependencies',
                ['route' => 'griffephotos_admin_option_dependency_plugin.option_dependency_index']
            )
            ->setLabel('Option Dependencies')
            ->setLabelAttribute('icon', 'cogs');
    }
}
