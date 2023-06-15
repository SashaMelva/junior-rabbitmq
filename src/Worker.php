<?php

namespace App;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Worker
{
    private function connection() {

    }
    private function close() {

    }

    /**
     * @throws \Exception
     */
    public function main(){
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) {
            $result = $this->fib($msg->body);
            echo ' [x] Received ', $result, "\n";
            sleep(substr_count($msg->body, '.'));
            echo " [x] Done\n";
        };

        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        while ($channel->is_open()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    private function fib($a)
    {
        if ($a === 0) {
            return 0;
        }
        if ($a === 1) {
            return 1;
        }
        return fib($a - 1) + fib($a - 2);
    }

    private function saveForMemcash() {

    }

}