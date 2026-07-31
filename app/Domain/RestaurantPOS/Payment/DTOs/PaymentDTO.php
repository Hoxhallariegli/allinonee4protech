<?php

namespace App\Domain\RestaurantPOS\Payment\DTOs;

class PaymentDTO
{
    public function __construct(
        public readonly mixed $order_id,
        public readonly mixed $amount,
        public readonly mixed $method,
    ) {}
    public static function fromArray(array $data): self { return new self(
            order_id: $data['order_id'] ?? null,
            amount: $data['amount'] ?? null,
            method: $data['method'] ?? null,
        ); }
    public function toArray(): array { return [
            'order_id' => $this->order_id,
            'amount' => $this->amount,
            'method' => $this->method,
        ]; }
}