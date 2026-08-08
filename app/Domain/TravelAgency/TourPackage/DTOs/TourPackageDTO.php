<?php

namespace App\Domain\TravelAgency\TourPackage\DTOs;

class TourPackageDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $destination_id,
        public readonly mixed $price,
        public readonly mixed $duration_days,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            destination_id: $data['destination_id'] ?? null,
            price: $data['price'] ?? null,
            duration_days: $data['duration_days'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'destination_id' => $this->destination_id,
            'price' => $this->price,
            'duration_days' => $this->duration_days,
            'photo' => $this->photo,
        ]; }
}