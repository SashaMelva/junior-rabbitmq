<?php

namespace App\Services;

class Response
{
    private string $status;
    private ?array $data;

    public function __construct(
        string $status,
        ?array $data
    )
    {
        $this->status = $status;
        $this->data = $data;
    }

    public function echoAsJson(): void
    {
        echo json_encode(['status' => $this->status, 'data' => $this->data]);
    }
}