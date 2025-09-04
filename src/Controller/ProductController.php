<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Controller;

use Raketa\BackendTestTask\Entity\Category;
use Raketa\BackendTestTask\View\ProductsView;
use Raketa\BackendTestTask\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

readonly class ProductController
{
    public function __construct(
        private ProductsView $productsVew,
        private ProductRepository $productRepository
    ) {
    }

    public function products(Category $category): JsonResponse
    {
        $products = $this->productRepository->findByCategory($category);

        return new JsonResponse($this->productsVew->toArray($products), 200);
    }
}
