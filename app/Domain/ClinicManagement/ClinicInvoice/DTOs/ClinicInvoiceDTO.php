<?php

namespace App\Domain\ClinicManagement\ClinicInvoice\DTOs;

class ClinicInvoiceDTO
{
    public function __construct(
        public readonly mixed $visit_id,
        public readonly mixed $amount,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            visit_id: $data['visit_id'] ?? null,
            amount: $data['amount'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'visit_id' => $this->visit_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ]; }
}