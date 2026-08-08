<?php

namespace App\Domain\AutoRepairManagement\InsuranceClaim\DTOs;

class InsuranceClaimDTO
{
    public function __construct(
        public readonly mixed $vehicle_id,
        public readonly mixed $policy_number,
        public readonly mixed $amount,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            vehicle_id: $data['vehicle_id'] ?? null,
            policy_number: $data['policy_number'] ?? null,
            amount: $data['amount'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'vehicle_id' => $this->vehicle_id,
            'policy_number' => $this->policy_number,
            'amount' => $this->amount,
            'status' => $this->status,
        ]; }
}