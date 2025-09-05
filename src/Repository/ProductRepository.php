<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Repository;

use Raketa\BackendTestTask\Entity\Category;
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

    public function findOneByUuidOrFail(string $uuid): Product
    {
        $product = $this->findOneBy(['uuid' => $uuid, 'isActive' => true]);

        if (is_null($product)) {
            throw new NotFoundHttpException('Product not found.');
        }

        return $product;
    }

    public function findByCategory(Category $category): array
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
