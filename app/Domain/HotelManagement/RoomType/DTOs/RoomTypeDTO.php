<?php

namespace App\Domain\HotelManagement\RoomType\DTOs;

class RoomTypeDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $base_price,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            base_price: $data['base_price'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'base_price' => $this->base_price,
            'photo' => $this->photo,
        ]; }
}