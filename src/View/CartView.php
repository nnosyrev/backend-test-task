<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\View;

use Raketa\BackendTestTask\Domain\Cart;

readonly class CartView
{
    public function toArray(Cart $cart): array
    {
        $data = [
            'uuid' => $cart->getUuid(),
        ];

        $data['items'] = [];
        foreach ($cart->getItems() as $item) {
            $data['items'][] = [
                'productUuid' => $item->getProductUuid(),
                'quantity' => $item->getQuantity(),
            ];
        }

        return $data;
    }
}
