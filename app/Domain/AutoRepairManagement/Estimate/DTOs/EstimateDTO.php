<?php

namespace App\Domain\AutoRepairManagement\Estimate\DTOs;

class EstimateDTO
{
    public function __construct(
        public readonly mixed $job_card_id,
        public readonly mixed $estimate_date,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            job_card_id: $data['job_card_id'] ?? null,
            estimate_date: $data['estimate_date'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'job_card_id' => $this->job_card_id,
            'estimate_date' => $this->estimate_date,
            'status' => $this->status,
        ]; }
}