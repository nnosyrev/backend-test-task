<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Controller;

use Psr\Http\Message\ResponseInterface;
use Raketa\BackendTestTask\View\ProductsView;

readonly class ProductController
{
    public function __construct(
        private ProductsView $productsVew
    ) {
    }

    public function products(string $category): ResponseInterface
    {
        $response = new JsonResponse();
        $response->getBody()->write(
            json_encode(
                $this->productsVew->toArray($category),
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            )
        );

        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus(200);
    }
}
