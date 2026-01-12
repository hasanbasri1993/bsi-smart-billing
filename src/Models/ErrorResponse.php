<?php

namespace Hasanbasri1993\BsiSmartBilling\Models;

class ErrorResponse
{
    private string $status;

    private string $message;

    public function __construct(array $data)
    {
        $this->status = $data['status'];
        $this->message = $data['message'];
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
