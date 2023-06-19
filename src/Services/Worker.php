<?php

namespace App\Services;

use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Worker
{
    private $connection;

    /**
     * @throws Exception
     */
    public function __constructor()
    {
        $this->connection = new AMQPStreamConnection(
            'jr-rabbitmq',
            5672,
            'guest',
            'guest'
        );
    }

    /**
     * @throws Exception
     */
    public function worker(): void
    {
        $channel = $this->connection->channel();
        $channel->queue_declare('hello', false, false, false, false);

        $callback = function ($msg) {
            $number = $msg->body;
            $result = $this->fib($number);
            (new RedisForResult())->putNewResultForKey((string)$number, (string)$result);
        };

        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        while ($channel->is_open()) {
            $channel->wait();
        }

        $channel->close();
        $this->connection->close();
    }

    /**
     * @throws Exception
     */
    public function send(int $number): void
    {
        $channel = $this->connection->channel();
        $channel->queue_declare('hello', false, false, false, false);

        $msg = new AMQPMessage($number);
        $channel->basic_publish($msg, '', 'hello');
    }

    private function fib(int $a): int
    {
        $fib1 = 0;
        $fib2 = 1;

        for ($i = 0; $i <= $a - 2; $i++) {
            $sum = $fib1 + $fib2;
            $fib1 = $fib2;
            $fib2 = $sum;
        }
        return $fib2;
    }
}