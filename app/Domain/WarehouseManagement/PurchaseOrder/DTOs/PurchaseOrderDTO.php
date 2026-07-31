<?php

namespace App\Domain\WarehouseManagement\PurchaseOrder\DTOs;

class PurchaseOrderDTO
{
    public function __construct(
        public readonly mixed $supplier_id,
        public readonly mixed $order_date,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            supplier_id: $data['supplier_id'] ?? null,
            order_date: $data['order_date'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'supplier_id' => $this->supplier_id,
            'order_date' => $this->order_date,
            'status' => $this->status,
        ]; }
}