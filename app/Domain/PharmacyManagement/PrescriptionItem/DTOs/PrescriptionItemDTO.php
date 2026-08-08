<?php

namespace App\Domain\PharmacyManagement\PrescriptionItem\DTOs;

class PrescriptionItemDTO
{
    public function __construct(
        public readonly mixed $prescription_id,
        public readonly mixed $medicine_id,
        public readonly mixed $quantity,
    ) {}
    public static function fromArray(array $data): self { return new self(
            prescription_id: $data['prescription_id'] ?? null,
            medicine_id: $data['medicine_id'] ?? null,
            quantity: $data['quantity'] ?? null,
        ); }
    public function toArray(): array { return [
            'prescription_id' => $this->prescription_id,
            'medicine_id' => $this->medicine_id,
            'quantity' => $this->quantity,
        ]; }
}