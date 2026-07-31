<?php

namespace App\Domain\RestaurantPOS\DiningTable\DTOs;

class DiningTableDTO
{
    public function __construct(
        public readonly mixed $number,
        public readonly mixed $capacity,
        public readonly mixed $status,
    ) {}
    public static function fromArray(array $data): self { return new self(
            number: $data['number'] ?? null,
            capacity: $data['capacity'] ?? null,
            status: $data['status'] ?? null,
        ); }
    public function toArray(): array { return [
            'number' => $this->number,
            'capacity' => $this->capacity,
            'status' => $this->status,
        ]; }
}