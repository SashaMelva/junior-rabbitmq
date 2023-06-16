<?php

namespace App;

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

        $this->sendForRabbitMQ($number1);
        $this->sendForRabbitMQ($number2);
        $this->sendForRabbitMQ($number3);
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

    public function updateResult(int $id)
    {

        $result = ;
        (new Response('success', $result))->echo();
    }
}