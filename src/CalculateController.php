<?php

namespace App;

use App\Services\View;
use App\Services\ViewPath;
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

        echo (new View(ViewPath::mainPagePath, ['result1' => $number1, 'result2' => $number2, 'result3' => $number3]));
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
        $channel->basic_publish($msg, '', 'hi');

        echo " [x] Sent 'Hello World!'\n";
    }

    public function viewMainContent(): View
    {
        return new View( ViewPath::mainPagePath, []);
    }

    public function updateResult(int $id)
    {
        echo 12 + $id;
    }
}