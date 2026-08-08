<?php

namespace App\Domain\HumanResources\Attendance\DTOs;

class AttendanceDTO
{
    public function __construct(
        public readonly mixed $employee_id,
        public readonly mixed $date,
        public readonly mixed $clock_in,
        public readonly mixed $clock_out,
    ) {}
    public static function fromArray(array $data): self { return new self(
            employee_id: $data['employee_id'] ?? null,
            date: $data['date'] ?? null,
            clock_in: $data['clock_in'] ?? null,
            clock_out: $data['clock_out'] ?? null,
        ); }
    public function toArray(): array { return [
            'employee_id' => $this->employee_id,
            'date' => $this->date,
            'clock_in' => $this->clock_in,
            'clock_out' => $this->clock_out,
        ]; }
}