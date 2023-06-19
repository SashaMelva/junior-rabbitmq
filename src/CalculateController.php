<?php

namespace App;

use App\Services\RedisForResult;
use App\Services\Response;
use App\Services\Worker;
use Exception;

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
        (new Worker())->send($number);
    }

    /**
     * @throws Exception
     */
    public function updateResult(int $key): void
    {
        $result = (new RedisForResult())->getResultForKey($key);
        if (is_null($result)) {
            (new Worker())->worker();
        }

        (new Response('success', ['result' => $result]))->echo();
    }
}