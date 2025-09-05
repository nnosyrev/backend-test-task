<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure;

use Redis;
use RedisException;

class RedisFactory
{
    public function __construct(
        private string $host,
        private int $port,
        private array $auth,
        private int $dbIndex
    ) {
    }

    public function createForCartStorage(): Redis
    {
        $redis = new Redis([
            'host' => $this->host,
            'port' => $this->port,
            'auth' => $this->auth,
            'connectTimeout' => 2.5,
            'ssl' => ['verify_peer' => false],
        ]);

        $redis->select($this->dbIndex);

        $this->checkConnection($redis);

        return $redis;
    }

    private function checkConnection(Redis $redis): void
    {
        if (!$redis->isConnected() || !$redis->ping()) {
            throw new RedisException('Unreachable redis server.');
        }
    }
}
