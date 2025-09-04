<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain;

final readonly class CartItem
{
    public function __construct(
        private string $productUuid,
        private int $quantity,
    ) {
    }

    public function getProductUuid(): string
    {
        return $this->productUuid;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
