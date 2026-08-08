<?php

namespace App\Domain\ECommerce\OrderItem\DTOs;

class OrderItemDTO
{
    public function __construct(
        public readonly mixed $order_id,
        public readonly mixed $product_id,
        public readonly mixed $quantity,
        public readonly mixed $price,
    ) {}
    public static function fromArray(array $data): self { return new self(
            order_id: $data['order_id'] ?? null,
            product_id: $data['product_id'] ?? null,
            quantity: $data['quantity'] ?? null,
            price: $data['price'] ?? null,
        ); }
    public function toArray(): array { return [
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]; }
}