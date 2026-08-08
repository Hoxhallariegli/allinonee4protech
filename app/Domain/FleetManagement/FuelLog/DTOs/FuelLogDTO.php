<?php

namespace App\Domain\FleetManagement\FuelLog\DTOs;

class FuelLogDTO
{
    public function __construct(
        public readonly mixed $vehicle_id,
        public readonly mixed $date,
        public readonly mixed $amount,
        public readonly mixed $cost,
    ) {}
    public static function fromArray(array $data): self { return new self(
            vehicle_id: $data['vehicle_id'] ?? null,
            date: $data['date'] ?? null,
            amount: $data['amount'] ?? null,
            cost: $data['cost'] ?? null,
        ); }
    public function toArray(): array { return [
            'vehicle_id' => $this->vehicle_id,
            'date' => $this->date,
            'amount' => $this->amount,
            'cost' => $this->cost,
        ]; }
}