<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Repository;

use Raketa\BackendTestTask\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getByUuid(string $uuid): Product
    {
        $product = $this->findOneBy(['uuid' => $uuid, 'isActive' => 1]);

        if (is_null($product)) {
            throw new NotFoundHttpException('Product not found.');
        }

        return $product;
    }

    public function getByCategory(string $category): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM Raketa\BackendTestTask\Entity\Product p
            WHERE p.isActive = 1
            AND p.category = :category'
        )->setParameter('category', $category);

        return $query->getResult();
    }
}
