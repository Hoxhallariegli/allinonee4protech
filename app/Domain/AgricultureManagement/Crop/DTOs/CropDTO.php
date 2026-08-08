<?php

namespace App\Domain\AgricultureManagement\Crop\DTOs;

class CropDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $field_id,
        public readonly mixed $planting_date,
        public readonly mixed $status,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            field_id: $data['field_id'] ?? null,
            planting_date: $data['planting_date'] ?? null,
            status: $data['status'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'field_id' => $this->field_id,
            'planting_date' => $this->planting_date,
            'status' => $this->status,
            'photo' => $this->photo,
        ]; }
}