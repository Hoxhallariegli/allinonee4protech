<?php

namespace App\Domain\AutoRepairManagement\PurchaseOrderItem\DTOs;

class PurchaseOrderItemDTO
{
    public function __construct(
        public readonly mixed $purchase_order_id,
        public readonly mixed $part_id,
        public readonly mixed $quantity,
        public readonly mixed $price,
    ) {}
    public static function fromArray(array $data): self { return new self(
            purchase_order_id: $data['purchase_order_id'] ?? null,
            part_id: $data['part_id'] ?? null,
            quantity: $data['quantity'] ?? null,
            price: $data['price'] ?? null,
        ); }
    public function toArray(): array { return [
            'purchase_order_id' => $this->purchase_order_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]; }
}