<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain;

use Ramsey\Uuid\Uuid;

final class Cart
{
    public function __construct(
        private readonly string $uuid,
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

    public function addItem(CartItem $new): void
    {
        foreach ($this->items as &$item) {
            if ($item->getProductUuid() === $new->getProductUuid()) {
                $item->addQuantity($new->getQuantity());
                return;
            }
        }

        $this->items[] = $new;
    }
}
