<?php

namespace App\Domain\TravelAgency\Destination\DTOs;

class DestinationDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $country,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            country: $data['country'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'country' => $this->country,
            'photo' => $this->photo,
        ]; }
}