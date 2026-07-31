<?php

namespace App\Domain\RestaurantPOS\Order\DTOs;

class OrderDTO
{
    public function __construct(
        public readonly mixed $table_id,
        public readonly mixed $waiter_id,
        public readonly mixed $order_date,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            table_id: $data['table_id'] ?? null,
            waiter_id: $data['waiter_id'] ?? null,
            order_date: $data['order_date'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'table_id' => $this->table_id,
            'waiter_id' => $this->waiter_id,
            'order_date' => $this->order_date,
            'status' => $this->status,
        ]; }
}