<?php

namespace GriffePhotos\OptionDependencyPlugin\Repository;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class OptionDependencyRepository extends EntityRepository
{
    /**
     * Trouve les dépendances impliquant les options données
     *
     * @param array $optionIds
     * @return array
     */
    public function findByOptions(array $optionIds)
    {
        $qb = $this->createQueryBuilder('od');

        $qb->where('od.parentOption IN (:optionIds)')
            ->orWhere('od.childOption IN (:optionIds)')
            ->setParameter('optionIds', $optionIds);

        return $qb->getQuery()->getResult();
    }
}
