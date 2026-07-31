<?php

namespace App\Domain\AutoRepairManagement\Vehicle\DTOs;

class VehicleDTO
{
    public function __construct(
        public readonly mixed $brand_id,
        public readonly mixed $model_id,
        public readonly mixed $year,
        public readonly mixed $customer_id,
        public readonly mixed $license_plate,
        public readonly mixed $vin,
    ) {}
    public static function fromArray(array $data): self { return new self(
            brand_id: $data['brand_id'] ?? null,
            model_id: $data['model_id'] ?? null,
            year: $data['year'] ?? null,
            customer_id: $data['customer_id'] ?? null,
            license_plate: $data['license_plate'] ?? null,
            vin: $data['vin'] ?? null,
        ); }
    public function toArray(): array { return [
            'brand_id' => $this->brand_id,
            'model_id' => $this->model_id,
            'year' => $this->year,
            'customer_id' => $this->customer_id,
            'license_plate' => $this->license_plate,
            'vin' => $this->vin,
        ]; }
}