<?php

namespace App;

use App\Services\RedisForResult;
use App\Services\Response;
use Exception;

class CalculateController
{
    /**
     * @throws Exception
     */
    public function validateInputData(int $number1, int $number2, int $number3): void
    {
        $numbers = [$number1, $number2, $number3];

        foreach ($numbers as $value){
            $this->processForRabbitMq($value);
        }
    }

    /**
     * @throws Exception
     */
    private function processForRabbitMq(int $number): void
    {

        if ($number < 30 || $number > 60) {
            return;
        }

        $resultForNumber = RedisForResult::fromDefaultSettings()->getResultByKey($number);

        if (is_null($resultForNumber)) {
            $this->sendForRabbitMQ($number);
        }
    }

    /**
     * @throws Exception
     */
    private function sendForRabbitMQ(int $number): void
    {
        Worker::withDefaultSettings()->send($number);
    }

    /**
     * @throws Exception
     */
    public function getResultOrRunWorkerIfThereIsNone(int $key): void
    {
        $result = (RedisForResult::fromDefaultSettings())->getResultByKey($key);

        if (is_null($result)) {
            Worker::withDefaultSettings()->run();
        }

        (new Response('success', ['result' => $result]))->echoAsJson();
    }
}