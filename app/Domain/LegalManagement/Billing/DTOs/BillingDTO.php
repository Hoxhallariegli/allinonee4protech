<?php

namespace App\Domain\LegalManagement\Billing\DTOs;

class BillingDTO
{
    public function __construct(
        public readonly mixed $case_id,
        public readonly mixed $amount,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            case_id: $data['case_id'] ?? null,
            amount: $data['amount'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'case_id' => $this->case_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ]; }
}