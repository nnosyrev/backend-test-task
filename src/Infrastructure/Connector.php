<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure;

use Raketa\BackendTestTask\Domain\Cart;
use Redis;

class Connector
{
    private Redis $redis;

    public function __construct($redis)
    {
        return $this->redis = $redis;
    }

    public function get(string $key)
    {
        $value = $this->redis->get($key);

        if (false === $value) {
            return null;
        }

        return unserialize($value);
    }

    public function set(string $key, Cart $value)
    {
        $this->redis->setex($key, 24 * 60 * 60, serialize($value));
    }

    public function has(string $key): bool
    {
        return $this->redis->exists($key);
    }
}
