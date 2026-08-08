<?php

namespace App\Domain\ClinicManagement\PatientAddress\DTOs;

class PatientAddressDTO
{
    public function __construct(
        public readonly mixed $patient_id,
        public readonly mixed $line1,
        public readonly mixed $city,
    ) {}
    public static function fromArray(array $data): self { return new self(
            patient_id: $data['patient_id'] ?? null,
            line1: $data['line1'] ?? null,
            city: $data['city'] ?? null,
        ); }
    public function toArray(): array { return [
            'patient_id' => $this->patient_id,
            'line1' => $this->line1,
            'city' => $this->city,
        ]; }
}