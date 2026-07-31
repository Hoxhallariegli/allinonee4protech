<?php

namespace App\Domain\WarehouseManagement\StockTransfer\DTOs;

class StockTransferDTO
{
    public function __construct(
        public readonly mixed $product_id,
        public readonly mixed $from_warehouse_id,
        public readonly mixed $to_warehouse_id,
        public readonly mixed $quantity,
    ) {}
    public static function fromArray(array $data): self { return new self(
            product_id: $data['product_id'] ?? null,
            from_warehouse_id: $data['from_warehouse_id'] ?? null,
            to_warehouse_id: $data['to_warehouse_id'] ?? null,
            quantity: $data['quantity'] ?? null,
        ); }
    public function toArray(): array { return [
            'product_id' => $this->product_id,
            'from_warehouse_id' => $this->from_warehouse_id,
            'to_warehouse_id' => $this->to_warehouse_id,
            'quantity' => $this->quantity,
        ]; }
}