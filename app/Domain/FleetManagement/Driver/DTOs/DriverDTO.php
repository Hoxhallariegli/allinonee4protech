<?php

namespace App\Domain\FleetManagement\Driver\DTOs;

class DriverDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $license_number,
        public readonly mixed $phone,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            license_number: $data['license_number'] ?? null,
            phone: $data['phone'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'license_number' => $this->license_number,
            'phone' => $this->phone,
            'photo' => $this->photo,
        ]; }
}