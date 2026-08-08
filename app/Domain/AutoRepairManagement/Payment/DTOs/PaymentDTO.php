<?php

namespace App\Domain\AutoRepairManagement\Payment\DTOs;

class PaymentDTO
{
    public function __construct(
        public readonly mixed $job_card_id,
        public readonly mixed $amount,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            job_card_id: $data['job_card_id'] ?? null,
            amount: $data['amount'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'job_card_id' => $this->job_card_id,
            'amount' => $this->amount,
            'status' => $this->status,
        ]; }
}