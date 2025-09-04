<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain;

use Ramsey\Uuid\Uuid;

final class Cart
{
    public function __construct(
        readonly private string $uuid,
        private array $items,
    ) {
    }

    static public function createEmpty()
    {
        return new Cart(Uuid::uuid4()->toString(), []);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(CartItem $item): void
    {
        $this->items[] = $item;
    }
}
