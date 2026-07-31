<?php

namespace App\Domain\ClinicManagement\Patient\DTOs;

class PatientDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $phone,
        public readonly mixed $birth_date,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            phone: $data['phone'] ?? null,
            birth_date: $data['birth_date'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
        ]; }
}