<?php

namespace App\Domain\FacilityManagement\Building\DTOs;

class BuildingDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $address,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            address: $data['address'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'address' => $this->address,
        ]; }
}