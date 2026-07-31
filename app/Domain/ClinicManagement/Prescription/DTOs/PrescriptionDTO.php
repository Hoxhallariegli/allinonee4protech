<?php

namespace App\Domain\ClinicManagement\Prescription\DTOs;

class PrescriptionDTO
{
    public function __construct(
        public readonly mixed $visit_id,
        public readonly mixed $medicine,
        public readonly mixed $dosage,
    ) {}
    public static function fromArray(array $data): self { return new self(
            visit_id: $data['visit_id'] ?? null,
            medicine: $data['medicine'] ?? null,
            dosage: $data['dosage'] ?? null,
        ); }
    public function toArray(): array { return [
            'visit_id' => $this->visit_id,
            'medicine' => $this->medicine,
            'dosage' => $this->dosage,
        ]; }
}