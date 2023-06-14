<?php

require_once 'vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('jr-rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('test', false, false, false, false);

$callback = function ($msg) {
    fib($msg->body);
    //TODO your code here
};
function fib($a)
{
    if ($a === 0) {
        return 0;
    }
    if ($a === 1) {
        return 1;
    }
    return fib($a - 1) + fib($a - 2);
}

$channel->basic_consume('test', '', false, true, false, false, $callback);

echo "\n started working \n";

while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();