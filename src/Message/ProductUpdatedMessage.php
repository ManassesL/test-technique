<?php

namespace App\Message;

class ProductUpdatedMessage
{
    private int $productId;
    private string $action;

    public function __construct(int $productId, string $action)
    {
        $this->productId = $productId;
        $this->action = $action;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}