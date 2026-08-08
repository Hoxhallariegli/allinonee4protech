<?php

namespace App\Domain\GymManagement\Subscription\DTOs;

class SubscriptionDTO
{
    public function __construct(
        public readonly mixed $member_id,
        public readonly mixed $start_date,
        public readonly mixed $end_date,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            member_id: $data['member_id'] ?? null,
            start_date: $data['start_date'] ?? null,
            end_date: $data['end_date'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'member_id' => $this->member_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]; }
}