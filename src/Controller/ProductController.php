<?php

namespace GriffePhotos\OptionDependencyPlugin\Controller;

use GriffePhotos\OptionDependencyPlugin\Entity\OptionDependencyInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $productRepository;

    private $doctrine;

    public function __construct(ProductRepositoryInterface $productRepository, \Doctrine\Persistence\ManagerRegistry $doctrine)
    {
        $this->productRepository = $productRepository;
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/products/{slug}", name="GriffePhotos_product_show")
     */
    public function showAction(string $slug): Response
    {
        $productRepository = $this->productRepository;
        $product = $productRepository->findOneByCode($slug);

        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }

        $dependencies = $this->doctrine
            ->getRepository(OptionDependencyInterface::class)
            ->findAll();

        return $this->render('@SyliusShop/Product/show.html.twig', [
            'product' => $product,
            'dependencies' => $dependencies,
        ]);
    }
}
