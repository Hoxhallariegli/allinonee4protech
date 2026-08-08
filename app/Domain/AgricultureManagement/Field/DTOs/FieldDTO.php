<?php

namespace App\Domain\AgricultureManagement\Field\DTOs;

class FieldDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $area_size,
        public readonly mixed $soil_type,
        public readonly mixed $location_photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            area_size: $data['area_size'] ?? null,
            soil_type: $data['soil_type'] ?? null,
            location_photo: $data['location_photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'area_size' => $this->area_size,
            'soil_type' => $this->soil_type,
            'location_photo' => $this->location_photo,
        ]; }
}