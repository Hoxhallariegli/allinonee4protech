<?php

namespace App\Domain\FleetManagement\Vehicle\DTOs;

class VehicleDTO
{
    public function __construct(
        public readonly mixed $make,
        public readonly mixed $model,
        public readonly mixed $year,
        public readonly mixed $license_plate,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            make: $data['make'] ?? null,
            model: $data['model'] ?? null,
            year: $data['year'] ?? null,
            license_plate: $data['license_plate'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'license_plate' => $this->license_plate,
            'photo' => $this->photo,
        ]; }
}