<?php

namespace App\Domain\VehicleModel\DTOs;

class VehicleModelDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $brand_id,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            brand_id: $data['brand_id'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'brand_id' => $this->brand_id,
        ]; }
}