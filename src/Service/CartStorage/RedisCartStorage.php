<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Service\CartStorage;

use Raketa\BackendTestTask\Domain\Cart;
use Symfony\Component\Serializer\SerializerInterface;

class RedisCartStorage implements CartStorageInterface
{
    private const PREFIX = 'cart_storage:';

    public function __construct(
        private SerializerInterface $serializer,
        // Объект инициализируется при помощи фабрики RedisFactory->createForCartStorage()
        // и инжектится сюда при помощи контейнера/DI фреймворка
        private Redis $redis,
        private int $duration
    ) {
    }

    public function save(string $clientHash, Cart $cart): void
    {
        $json = $this->serializer->serialize($cart, 'json');

        $key = $this->generateKey($clientHash);

        $result = $this->redis->setEx($key, $this->duration, $json);

        if (true !== $result) {
            throw new CartStorageException('Failed recording attempt.');
        }
    }

    public function get(string $clientHash): ?Cart
    {
        $key = $this->generateKey($clientHash);

        $json = $this->redis->get($key);

        if (false === $json) {
            return null;
        }

        $cart = $this->serializer->deserialize($json, Cart::class, 'json');

        return $cart;
    }

    private function generateKey(string $clientHash): string
    {
        return self::PREFIX . $clientHash;
    }
}
