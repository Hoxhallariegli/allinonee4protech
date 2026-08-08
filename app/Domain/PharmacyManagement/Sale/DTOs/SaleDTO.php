<?php

namespace App\Domain\PharmacyManagement\Sale\DTOs;

class SaleDTO
{
    public function __construct(
        public readonly mixed $total_amount,
        public readonly mixed $sale_date,
    ) {}
    public static function fromArray(array $data): self { return new self(
            total_amount: $data['total_amount'] ?? null,
            sale_date: $data['sale_date'] ?? null,
        ); }
    public function toArray(): array { return [
            'total_amount' => $this->total_amount,
            'sale_date' => $this->sale_date,
        ]; }
}