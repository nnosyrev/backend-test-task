<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Service\CartStorage;

use Raketa\BackendTestTask\Domain\Cart;

interface CartStorageInterface
{
    public function save(string $clientHash, Cart $cart): void;

    public function get(string $clientHash): ?Cart;
}
