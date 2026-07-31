<?php

namespace App\Domain\RestaurantPOS\Waiter\DTOs;

class WaiterDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $phone,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            phone: $data['phone'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'phone' => $this->phone,
        ]; }
}