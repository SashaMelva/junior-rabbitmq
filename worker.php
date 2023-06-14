<?php

require_once 'vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('jr-rabbitmq', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('test', false, false, false, false);

$callback = function () {
    //TODO your code here
};
$channel->basic_consume('test', '', false, true, false, false, $callback);

echo "\n started working \n";

while ($channel->is_open()) {
    $channel->wait();
}
