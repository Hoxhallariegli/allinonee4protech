<?php

namespace App\Domain\Sale\DTOs;

class SaleDTO
{
    public function __construct(
        public readonly ?string $user_id,
        public readonly ?string $product_id,
        public readonly ?int $quantity,
        public readonly ?float $total_price,
        public readonly ?string $sale_date,
        public readonly ?string $status,
        public readonly ?string $notes,
        public readonly ?string $no,
    ) {}
    public static function fromArray(array $data): self { return new self(
            user_id: $data['user_id'] ?? null,
            product_id: $data['product_id'] ?? null,
            quantity: $data['quantity'] ?? null,
            total_price: $data['total_price'] ?? null,
            sale_date: $data['sale_date'] ?? null,
            status: $data['status'] ?? null,
            notes: $data['notes'] ?? null,
            no: $data['no'] ?? null,
        ); }
    public function toArray(): array { return [
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'sale_date' => $this->sale_date,
            'status' => $this->status,
            'notes' => $this->notes,
            'no' => $this->no,
        ]; }
}