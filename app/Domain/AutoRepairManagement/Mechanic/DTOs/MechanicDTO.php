<?php

namespace App\Domain\AutoRepairManagement\Mechanic\DTOs;

class MechanicDTO
{
    public function __construct(
        public readonly mixed $employee_id,
        public readonly mixed $specialization,
    ) {}
    public static function fromArray(array $data): self { return new self(
            employee_id: $data['employee_id'] ?? null,
            specialization: $data['specialization'] ?? null,
        ); }
    public function toArray(): array { return [
            'employee_id' => $this->employee_id,
            'specialization' => $this->specialization,
        ]; }
}