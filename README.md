<p align="center">
    <a href="https://sylius.com" target="_blank">
        <img src="https://sylius.com/wp-content/uploads/2021/03/sylius-logo_sylius-logo-dark-1024x423.jpg" />
    </a>
</p>



# Plugin GriffePhotos Option Dependency

Ce plugin ajoute la gestion des dépendances d'options pour les produits dans Sylius. Avec ce plugin, vous pouvez définir des relations conditionnelles entre les options des produits, ce qui permet d’afficher ou de masquer certaines options en fonction de choix précédents.

## Installation

Suivez ces étapes pour installer et configurer le plugin.

### 1. Installation du package

Ajoutez le package dans votre projet (modifiez la commande si le package est sur un dépôt privé) :

```bash
composer require griffephotos/option-dependency-plugin
```

### 2. Configurations requises

#### **Ajout des routes**

Ouvrez votre fichier `config/routes.yaml` et ajoutez la route du plugin :

```yaml
GriffePhotos_option_dependency_plugin:
    resource: "@GriffePhotosOptionDependencyPlugin/Resources/config/routing.yaml"
```

#### **Ajout des ressources**

Ouvrez le fichier `_sylius.yaml` (généralement situé dans `config/packages/_sylius.yaml`) et ajoutez les ressources suivantes :

```yaml
    - {
          resource: "@GriffePhotosOptionDependencyPlugin/Resources/config/resources.yaml",
      }
    - {
          resource: "@GriffePhotosOptionDependencyPlugin/Resources/config/grids.yaml",
      }
    - {
          resource: "@GriffePhotosOptionDependencyPlugin/Resources/config/services.yaml",
      }
```

#### **Enregistrement du plugin dans `bundles.php`**

Vérifiez que le plugin est bien enregistré dans `config/bundles.php`. Si ce n'est pas le cas, ajoutez-le manuellement :

```php
GriffePhotos\OptionDependencyPlugin\GriffePhotosOptionDependencyPlugin::class => ['all' => true],
```

### 3. Migration de la base de données

Le plugin inclut une entité pour gérer les dépendances d'options. Vous devez donc générer et exécuter les migrations pour créer la table associée dans la base de données.

Exécutez les commandes suivantes :

```bash
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```

## Utilisation

Après l’installation, vous pouvez accéder à l'interface d'administration pour configurer les dépendances entre options. Les options sont ensuite appliquées automatiquement dans le panier et lors de l'achat en fonction des règles définies.

## Support

Pour toute question ou suggestion, n'hésitez pas à ouvrir une issue ou à contacter l'équipe de GriffePhotos.
