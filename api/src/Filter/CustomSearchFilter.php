<?php
// src/Filter/CustomSearchFilter.php
namespace App\Filter;

use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\QueryBuilder;

final class CustomSearchFilter extends AbstractFilter
{
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void
    {
        if ($property !== 'custom_search') {
            return;
        }

        $alias = $queryBuilder->getRootAliases()[0];
        $queryBuilder
            ->andWhere(sprintf('%s.nom LIKE :search OR %s.description LIKE :search', $alias, $alias))
            ->setParameter('search', '%' . $value . '%');
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'custom_search' => [
                'property' => 'custom_search',
                'type' => 'string',
                'required' => false,
                'swagger' => [
                    'description' => 'Recherche personnalisée sur nom et description',
                    'name' => 'custom_search',
                    'type' => 'string',
                ],
            ],
        ];
    }
}