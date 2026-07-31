<?php

namespace App\Domain\RestaurantPOS\OrderItem\DTOs;

class OrderItemDTO
{
    public function __construct(
        public readonly mixed $order_id,
        public readonly mixed $menu_item_id,
        public readonly mixed $quantity,
    ) {}
    public static function fromArray(array $data): self { return new self(
            order_id: $data['order_id'] ?? null,
            menu_item_id: $data['menu_item_id'] ?? null,
            quantity: $data['quantity'] ?? null,
        ); }
    public function toArray(): array { return [
            'order_id' => $this->order_id,
            'menu_item_id' => $this->menu_item_id,
            'quantity' => $this->quantity,
        ]; }
}