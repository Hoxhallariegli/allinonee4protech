<?php

namespace App\Domain\PharmacyManagement\Prescription\DTOs;

class PrescriptionDTO
{
    public function __construct(
        public readonly mixed $patient_name,
        public readonly mixed $doctor_name,
        public readonly mixed $date,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            patient_name: $data['patient_name'] ?? null,
            doctor_name: $data['doctor_name'] ?? null,
            date: $data['date'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'patient_name' => $this->patient_name,
            'doctor_name' => $this->doctor_name,
            'date' => $this->date,
            'photo' => $this->photo,
        ]; }
}