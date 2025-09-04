<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Controller;

use Raketa\BackendTestTask\Entity\Category;
use Raketa\BackendTestTask\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

readonly class ProductController
{
    public function __construct(
        private ProductRepository $productRepository,
        private SerializerInterface $serializer
    ) {
    }

    public function products(Category $category): JsonResponse
    {
        $products = $this->productRepository->findByCategory($category);

        $json = $this->serializer->serialize($products, 'json');

        return JsonResponse::fromJsonString($json, 200);
    }
}
