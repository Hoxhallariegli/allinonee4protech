<?php

namespace App\Domain\BerberApp\Service\DTOs;

class ServiceDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $duration_minutes,
        public readonly mixed $price,
        public readonly mixed $active,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            duration_minutes: $data['duration_minutes'] ?? null,
            price: $data['price'] ?? null,
            active: $data['active'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'duration_minutes' => $this->duration_minutes,
            'price' => $this->price,
            'active' => $this->active,
        ]; }
}