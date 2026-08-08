<?php

namespace App\Domain\ECommerce\Order\DTOs;

class OrderDTO
{
    public function __construct(
        public readonly mixed $customer_id,
        public readonly mixed $total,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            customer_id: $data['customer_id'] ?? null,
            total: $data['total'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'customer_id' => $this->customer_id,
            'total' => $this->total,
            'status' => $this->status,
        ]; }
}