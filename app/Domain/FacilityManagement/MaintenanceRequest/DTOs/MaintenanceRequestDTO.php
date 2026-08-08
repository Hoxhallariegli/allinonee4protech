<?php

namespace App\Domain\FacilityManagement\MaintenanceRequest\DTOs;

class MaintenanceRequestDTO
{
    public function __construct(
        public readonly mixed $building_id,
        public readonly mixed $technician_id,
        public readonly mixed $description,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            building_id: $data['building_id'] ?? null,
            technician_id: $data['technician_id'] ?? null,
            description: $data['description'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'building_id' => $this->building_id,
            'technician_id' => $this->technician_id,
            'description' => $this->description,
            'status' => $this->status,
        ]; }
}