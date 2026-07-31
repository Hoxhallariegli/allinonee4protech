<?php

namespace App\Domain\WarehouseManagement\Sale\DTOs;

class SaleDTO
{
    public function __construct(
        public readonly mixed $customer_id,
        public readonly mixed $sale_date,
        public readonly mixed $total,
    ) {}
    public static function fromArray(array $data): self { return new self(
            customer_id: $data['customer_id'] ?? null,
            sale_date: $data['sale_date'] ?? null,
            total: $data['total'] ?? null,
        ); }
    public function toArray(): array { return [
            'customer_id' => $this->customer_id,
            'sale_date' => $this->sale_date,
            'total' => $this->total,
        ]; }
}