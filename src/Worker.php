<?php

namespace App;

use App\Services\RedisForResult;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Worker
{
    /**
     * @throws \Exception
     */
    public function main()
    {
        $connection = new AMQPStreamConnection('jr-rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

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
        $connection->close();
    }

//    private function fib($a)
//    {
//        if ($a === 0) {
//            return 0;
//        }
//        if ($a === 1) {
//            return 1;
//        }
//        return fib($a - 1) + fib($a - 2);
//    }
    private function fib($a)
    {
        if ($a === 0) {
            return 0;
        }
        if ($a === 1) {
            return 1;
        }
        return $a * 100;
    }
}