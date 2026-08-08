<?php

namespace App\Domain\HumanResources\Payroll\DTOs;

class PayrollDTO
{
    public function __construct(
        public readonly mixed $employee_id,
        public readonly mixed $month,
        public readonly mixed $amount,
        public readonly mixed $is_paid,
    ) {}
    public static function fromArray(array $data): self { return new self(
            employee_id: $data['employee_id'] ?? null,
            month: $data['month'] ?? null,
            amount: $data['amount'] ?? null,
            is_paid: $data['is_paid'] ?? null,
        ); }
    public function toArray(): array { return [
            'employee_id' => $this->employee_id,
            'month' => $this->month,
            'amount' => $this->amount,
            'is_paid' => $this->is_paid,
        ]; }
}