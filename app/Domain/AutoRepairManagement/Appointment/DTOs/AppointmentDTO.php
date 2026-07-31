<?php

namespace App\Domain\AutoRepairManagement\Appointment\DTOs;

class AppointmentDTO
{
    public function __construct(
        public readonly mixed $vehicle_id,
        public readonly mixed $appointment_date,
        public readonly mixed $status,
        public readonly mixed $notes,
    ) {}
    public static function fromArray(array $data): self { return new self(
            vehicle_id: $data['vehicle_id'] ?? null,
            appointment_date: $data['appointment_date'] ?? null,
            status: $data['status'] ?? null,
            notes: $data['notes'] ?? null,
        ); }
    public function toArray(): array { return [
            'vehicle_id' => $this->vehicle_id,
            'appointment_date' => $this->appointment_date,
            'status' => $this->status,
            'notes' => $this->notes,
        ]; }
}