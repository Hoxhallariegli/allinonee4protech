<?php

namespace App\Domain\AutoRepairManagement\InvoiceItem\DTOs;

class InvoiceItemDTO
{
    public function __construct(
        public readonly mixed $invoice_id,
        public readonly mixed $service_id,
        public readonly mixed $part_id,
        public readonly mixed $quantity,
        public readonly mixed $price,
    ) {}
    public static function fromArray(array $data): self { return new self(
            invoice_id: $data['invoice_id'] ?? null,
            service_id: $data['service_id'] ?? null,
            part_id: $data['part_id'] ?? null,
            quantity: $data['quantity'] ?? null,
            price: $data['price'] ?? null,
        ); }
    public function toArray(): array { return [
            'invoice_id' => $this->invoice_id,
            'service_id' => $this->service_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]; }
}