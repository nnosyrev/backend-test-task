<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\View;

use Raketa\BackendTestTask\Domain\Cart;
use Raketa\BackendTestTask\Repository\ProductRepository;

readonly class CartView
{
    public function __construct(
        private ProductRepository $productRepository
    ) {
    }

    public function toArray(Cart $cart): array
    {
        $data = [
            'uuid' => $cart->getUuid(),
        ];

        $total = 0;
        $data['items'] = [];
        foreach ($cart->getItems() as $item) {
            $total += $item->getPrice() * $item->getQuantity();
            $product = $this->productRepository->findOneByUuidOrFail($item->getProductUuid());

            $data['items'][] = [
                'uuid' => $item->getUuid(),
                'price' => $item->getPrice(),
                'total' => $total,
                'quantity' => $item->getQuantity(),
                'product' => [
                    'id' => $product->getId(),
                    'uuid' => $product->getUuid(),
                    'name' => $product->getName(),
                    'thumbnail' => $product->getThumbnail(),
                    'price' => $product->getPrice(),
                ],
            ];
        }

        $data['total'] = $total;

        return $data;
    }
}
