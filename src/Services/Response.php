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
        $this->data = $data;
        $this->status = $status;
    }

    public function echo(): void
    {
        echo json_encode(['status' => $this->status, 'data' => $this->data]);
    }
}