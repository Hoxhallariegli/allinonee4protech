<?php

namespace App\Domain\ClinicManagement\MedicalVital\DTOs;

class MedicalVitalDTO
{
    public function __construct(
        public readonly mixed $patient_id,
        public readonly mixed $weight_kg,
        public readonly mixed $blood_pressure,
        public readonly mixed $pulse_bpm,
        public readonly mixed $temperature_c,
        public readonly mixed $recorded_at,
    ) {}
    public static function fromArray(array $data): self { return new self(
            patient_id: $data['patient_id'] ?? null,
            weight_kg: $data['weight_kg'] ?? null,
            blood_pressure: $data['blood_pressure'] ?? null,
            pulse_bpm: $data['pulse_bpm'] ?? null,
            temperature_c: $data['temperature_c'] ?? null,
            recorded_at: $data['recorded_at'] ?? null,
        ); }
    public function toArray(): array { return [
            'patient_id' => $this->patient_id,
            'weight_kg' => $this->weight_kg,
            'blood_pressure' => $this->blood_pressure,
            'pulse_bpm' => $this->pulse_bpm,
            'temperature_c' => $this->temperature_c,
            'recorded_at' => $this->recorded_at,
        ]; }
}