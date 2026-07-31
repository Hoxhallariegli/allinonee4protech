<?php

namespace App\Domain\ClinicManagement\Visit\DTOs;

class VisitDTO
{
    public function __construct(
        public readonly mixed $patient_id,
        public readonly mixed $doctor_id,
        public readonly mixed $visit_date,
        public readonly mixed $diagnosis,
    ) {}
    public static function fromArray(array $data): self { return new self(
            patient_id: $data['patient_id'] ?? null,
            doctor_id: $data['doctor_id'] ?? null,
            visit_date: $data['visit_date'] ?? null,
            diagnosis: $data['diagnosis'] ?? null,
        ); }
    public function toArray(): array { return [
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'visit_date' => $this->visit_date,
            'diagnosis' => $this->diagnosis,
        ]; }
}