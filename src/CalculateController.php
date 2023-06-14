<?php

use App\Services\ViewPath;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class CalculateController
{
    /**
     * @throws Exception
     */
    public function validationCalculation(int $number1, int $number2, int $number3)
    {
        if ($number1 < 30 || $number1 > 60) {
            return (new View((new ViewPath())->mainPagePath(), []));
        }
        if ($number2 < 30 || $number2 > 60) {
            return null;
        }
        if ($number3 < 30 || $number3 > 60) {
            return null;
        }

        $this->sendForRabbitMQ($number1, $number2, $number3);
    }

    /**
     * @throws Exception
     */
    private function sendForRabbitMQ(int $number1, int $number2, int $number3)
    {
        $connection = new AMQPStreamConnection('jr-rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        $msg = new AMQPMessage([$number1, $number2, $number3]);
        $channel->basic_publish($msg, '', 'hello');

        echo " [x] Sent 'Hello World!'\n";
    }

    public function viewMainContent(): View
    {
        return (new View((new ViewPath())->mainPagePath(), []));
    }
}