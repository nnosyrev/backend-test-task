<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Controller;

use Raketa\BackendTestTask\View\ProductsView;
use Symfony\Component\HttpFoundation\JsonResponse;

readonly class ProductController
{
    public function __construct(
        private ProductsView $productsVew
    ) {
    }

    public function products(string $category): JsonResponse
    {
        return new JsonResponse($this->productsVew->toArray($category), 200);
    }
}
