<?php

namespace App\Domain\RestaurantPOS\Category\DTOs;

class CategoryDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'photo' => $this->photo,
        ]; }
}