<?php

namespace App\Domain\AutoRepairManagement\JobCard\DTOs;

class JobCardDTO
{
    public function __construct(
        public readonly mixed $vehicle_id,
        public readonly mixed $customer_id,
        public readonly mixed $mechanic_id,
        public readonly mixed $status,
        public readonly mixed $opened_at,
        public readonly mixed $closed_at,
    ) {}
    public static function fromArray(array $data): self { return new self(
            vehicle_id: $data['vehicle_id'] ?? null,
            customer_id: $data['customer_id'] ?? null,
            mechanic_id: $data['mechanic_id'] ?? null,
            status: $data['status'] ?? null,
            opened_at: $data['opened_at'] ?? null,
            closed_at: $data['closed_at'] ?? null,
        ); }
    public function toArray(): array { return [
            'vehicle_id' => $this->vehicle_id,
            'customer_id' => $this->customer_id,
            'mechanic_id' => $this->mechanic_id,
            'status' => $this->status,
            'opened_at' => $this->opened_at,
            'closed_at' => $this->closed_at,
        ]; }
}