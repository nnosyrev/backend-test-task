<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain;

final class CartItem
{
    public function __construct(
        private readonly string $productUuid,
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

    public function addQuantity(int $quantity): static
    {
        $this->quantity += $quantity;

        return $this;
    }
}
