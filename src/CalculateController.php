<?php

namespace App;

use App\Services\RedisForResult;
use App\Services\Response;
use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


class CalculateController
{
    /**
     * @throws Exception
     */
    public function validationCalculation(int $number1, int $number2, int $number3): void
    {
        if ($number1 < 30 || $number1 > 60) {
            echo null;
        }
        if ($number2 < 30 || $number2 > 60) {
            echo null;
        }
        if ($number3 < 30 || $number3 > 60) {
            echo null;
        }

        $result = (new RedisForResult())->getResultForKey($number1);
        if (is_null($result)) {
            $this->sendForRabbitMQ($number1);
        }

        $result = (new RedisForResult())->getResultForKey($number2);
        if (is_null($result)) {
            $this->sendForRabbitMQ($number2);
        }

        $result = (new RedisForResult())->getResultForKey($number3);
        if (is_null($result)) {
            $this->sendForRabbitMQ($number3);
        }
    }

    /**
     * @throws Exception
     */
    private function sendForRabbitMQ(int $number): void
    {
        $connection = new AMQPStreamConnection('jr-rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        $msg = new AMQPMessage($number);
        $channel->basic_publish($msg, '', 'hello');
    }

    /**
     * @throws Exception
     */
    public function updateResult(int $key)
    {
        $result = (new RedisForResult())->getResultForKey($key);
        if (is_null($result)) {
            (new Worker())->main();
        }

        (new Response('success', ['result' => $result]))->echo();
    }
}