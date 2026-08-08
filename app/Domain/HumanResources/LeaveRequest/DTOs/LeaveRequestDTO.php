<?php

namespace App\Domain\HumanResources\LeaveRequest\DTOs;

class LeaveRequestDTO
{
    public function __construct(
        public readonly mixed $employee_id,
        public readonly mixed $leave_type,
        public readonly mixed $start_date,
        public readonly mixed $end_date,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            employee_id: $data['employee_id'] ?? null,
            leave_type: $data['leave_type'] ?? null,
            start_date: $data['start_date'] ?? null,
            end_date: $data['end_date'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'employee_id' => $this->employee_id,
            'leave_type' => $this->leave_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]; }
}