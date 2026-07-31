<?php

namespace App\Domain\AutoRepairManagement\EstimateItem\DTOs;

class EstimateItemDTO
{
    public function __construct(
        public readonly mixed $estimate_id,
        public readonly mixed $service_id,
        public readonly mixed $part_id,
        public readonly mixed $quantity,
    ) {}
    public static function fromArray(array $data): self { return new self(
            estimate_id: $data['estimate_id'] ?? null,
            service_id: $data['service_id'] ?? null,
            part_id: $data['part_id'] ?? null,
            quantity: $data['quantity'] ?? null,
        ); }
    public function toArray(): array { return [
            'estimate_id' => $this->estimate_id,
            'service_id' => $this->service_id,
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
        ]; }
}