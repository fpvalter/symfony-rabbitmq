<?php

namespace App\Message;

final class InvoiceMessage
{
    private int $customerId;
    private float $value;
    private string $details;

    public function __construct($customerId, $value, $details=null)
    {
        $this->customerId = $customerId;
        $this->value = $value;
        $this->details = $details;
    }

    public function getCustomerId(): int 
    {
        return $this->customerId;
    }

    public function getValue(): float 
    {
        return $this->value;
    }

    public function getDetails(): string
    {
        return $this->details;
    }
}
