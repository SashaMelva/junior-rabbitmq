<?php

namespace App\Services;

use Predis\Client;

class RedisForResult
{
    private Client $redisClient;

    public function __construct(Client $redisClient)
    {
        $this->redisClient = $redisClient;
    }

    public static function fromDefaultSettings(): self
    {
        $redisClient = new Client(
            [
                'scheme' => 'tcp',
                'host' => 'docker-redis-1',
                'port' => '6379'
            ]
        );

        return new self($redisClient);
    }

    public function getResultByKey(string $keyAsNumber): ?string
    {
        return $this->redisClient->get($keyAsNumber);
    }

    public function addResultByKey(string $keyAsNumber, string $result): void
    {
        $this->redisClient->set($keyAsNumber, $result);
    }
}