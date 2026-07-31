<?php

namespace App\Domain\ConstructionERP\Apartment\DTOs;

class ApartmentDTO
{
    public function __construct(
        public readonly mixed $building_id,
        public readonly mixed $number,
        public readonly mixed $area,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            building_id: $data['building_id'] ?? null,
            number: $data['number'] ?? null,
            area: $data['area'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'building_id' => $this->building_id,
            'number' => $this->number,
            'area' => $this->area,
            'status' => $this->status,
        ]; }
}