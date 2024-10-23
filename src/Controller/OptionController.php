<?php

namespace GriffePhotos\OptionDependencyPlugin\Controller;

use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class OptionController
{
    private $productOptionValueRepository;

    public function __construct(RepositoryInterface $productOptionValueRepository)
    {
        $this->productOptionValueRepository = $productOptionValueRepository;
    }

    public function getOptionValues(int $optionId): JsonResponse
    {
        $optionValues = $this->productOptionValueRepository->findBy(['option' => $optionId]);

        $data = [];

        foreach ($optionValues as $value) {
            $data[] = [
                'id' => $value->getId(),
                'value' => $value->getValue(),
            ];
        }

        return new JsonResponse($data);
    }
}
