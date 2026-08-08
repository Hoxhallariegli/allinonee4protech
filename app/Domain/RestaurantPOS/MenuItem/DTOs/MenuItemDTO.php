<?php

namespace App\Domain\RestaurantPOS\MenuItem\DTOs;

class MenuItemDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $price,
        public readonly mixed $category_id,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            price: $data['price'] ?? null,
            category_id: $data['category_id'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'photo' => $this->photo,
        ]; }
}
