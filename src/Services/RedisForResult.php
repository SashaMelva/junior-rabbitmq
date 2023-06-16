<?php

namespace App\Services;

use Predis\Client;

class RedisForResult
{
    private $predis;

    public function __construct()
    {
        $this->predis = new Client(
            [
                'scheme' => 'tcp',
                'host' => 'docker-redis-1',
                'port' => '6379'
            ]
        );
    }

    public function getResultForKey(string $key): ?string
    {
        return $this->predis->get($key);
    }

    public function putNewResultForKey(string $number, string $value): void
    {
        $this->predis->set($number, $value);
    }

    public function deleteKeyUser(int $userId): void
    {
        $this->predis->del('user:' . $userId);
    }
}