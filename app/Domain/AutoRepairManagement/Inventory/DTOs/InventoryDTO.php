<?php

namespace App\Domain\AutoRepairManagement\Inventory\DTOs;

class InventoryDTO
{
    public function __construct(
        public readonly mixed $part_id,
        public readonly mixed $quantity,
    ) {}
    public static function fromArray(array $data): self { return new self(
            part_id: $data['part_id'] ?? null,
            quantity: $data['quantity'] ?? null,
        ); }
    public function toArray(): array { return [
            'part_id' => $this->part_id,
            'quantity' => $this->quantity,
        ]; }
}