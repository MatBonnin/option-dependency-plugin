<?php
// src/Controller/Shop/OptionDependencyController.php
namespace GriffePhotos\OptionDependencyPlugin\Controller\Shop;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Product\Repository\ProductRepositoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\ORM\EntityManagerInterface;
use GriffePhotos\OptionDependencyPlugin\Repository\OptionDependencyRepository;
use Sylius\Component\Core\Model\ProductInterface;

class OptionDependencyController
{
    private $optionDependencyRepository;
    private $productRepository;
    private $locale;
    private $entityManager;

    public function __construct(
        OptionDependencyRepository $optionDependencyRepository,
        ProductRepositoryInterface $productRepository,
        RequestStack $requestStack,
        EntityManagerInterface $entityManager
    ) {
        $this->optionDependencyRepository = $optionDependencyRepository;
        $this->productRepository = $productRepository;
        $this->locale = $requestStack->getCurrentRequest()->getLocale();
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/product/{slug}/option-dependencies", name="griffephotos_shop_option_dependencies", methods={"GET"})
     */
    public function getOptionDependencies(string $slug): JsonResponse
    {
        $qb = $this->entityManager->createQueryBuilder();

        // Récupérer le produit à partir de son slug et de la locale
        $qb->select('p')
            ->from(ProductInterface::class, 'p')
            ->innerJoin('p.translations', 't')
            ->where('t.slug = :slug')
            ->andWhere('t.locale = :locale')
            ->setParameter('slug', $slug)
            ->setParameter('locale', $this->locale);

        $product = $qb->getQuery()->getOneOrNullResult();

        if (!$product) {
            return new JsonResponse(['error' => 'Produit non trouvé'], 404);
        }

        // Récupérer les options du produit
        $productOptions = $product->getOptions();

        if ($productOptions->isEmpty()) {
            // Le produit n'a pas d'options
            return new JsonResponse([]);
        }

        // Récupérer les IDs des options du produit
        $optionIds = [];
        foreach ($productOptions as $option) {
            $optionIds[] = $option->getId();
        }

        // Récupérer les dépendances qui concernent ces options
        $dependencies = $this->optionDependencyRepository->findByOptions($optionIds);

        // Formater les données pour le front-end avec l'ID, le nom de l'option, et la valeur des OptionValue
        $data = [];
        foreach ($dependencies as $dependency) {
            $data[] = [
                'parentOption' => [
                    'id' => $dependency->getParentOption()->getId(),
                    'name' => $dependency->getParentOption()->getCode(), // Nom de l'option parent
                ],
                'parentOptionValue' => [
                    'id' => $dependency->getParentOptionValue()->getId(),
                    'value' => $dependency->getParentOptionValue()->getCode(), // Valeur de l'option parent
                ],
                'childOption' => [
                    'id' => $dependency->getChildOption()->getId(),
                    'name' => $dependency->getChildOption()->getCode(), // Nom de l'option enfant
                ],
            ];
        }

        return new JsonResponse($data);
    }
}
