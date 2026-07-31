<?php

namespace App\Domain\AutoRepairManagement\VehicleBrand\DTOs;

class VehicleBrandDTO
{
    public function __construct(
        public readonly mixed $name,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
        ]; }
}