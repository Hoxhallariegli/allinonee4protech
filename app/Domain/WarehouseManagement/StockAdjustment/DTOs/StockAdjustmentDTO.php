<?php

namespace App\Domain\WarehouseManagement\StockAdjustment\DTOs;

class StockAdjustmentDTO
{
    public function __construct(
        public readonly mixed $product_id,
        public readonly mixed $warehouse_id,
        public readonly mixed $quantity,
        public readonly mixed $adjustment_type,
        public readonly mixed $reason,
    ) {}
    public static function fromArray(array $data): self { return new self(
            product_id: $data['product_id'] ?? null,
            warehouse_id: $data['warehouse_id'] ?? null,
            quantity: $data['quantity'] ?? null,
            adjustment_type: $data['adjustment_type'] ?? null,
            reason: $data['reason'] ?? null,
        ); }
    public function toArray(): array { return [
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'quantity' => $this->quantity,
            'adjustment_type' => $this->adjustment_type,
            'reason' => $this->reason,
        ]; }
}