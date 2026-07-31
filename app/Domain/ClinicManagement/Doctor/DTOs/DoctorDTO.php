<?php

namespace App\Domain\ClinicManagement\Doctor\DTOs;

class DoctorDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $specialization,
        public readonly mixed $phone,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            specialization: $data['specialization'] ?? null,
            phone: $data['phone'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'specialization' => $this->specialization,
            'phone' => $this->phone,
        ]; }
}