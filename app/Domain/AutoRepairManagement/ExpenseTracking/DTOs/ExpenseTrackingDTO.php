<?php

namespace App\Domain\AutoRepairManagement\ExpenseTracking\DTOs;

class ExpenseTrackingDTO
{
    public function __construct(
        public readonly mixed $description,
        public readonly mixed $amount,
        public readonly mixed $date,
    ) {}
    public static function fromArray(array $data): self { return new self(
            description: $data['description'] ?? null,
            amount: $data['amount'] ?? null,
            date: $data['date'] ?? null,
        ); }
    public function toArray(): array { return [
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $this->date,
        ]; }
}