<?php

namespace App\Domain\PharmacyManagement\Medicine\DTOs;

class MedicineDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $category,
        public readonly mixed $price,
        public readonly mixed $stock,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            category: $data['category'] ?? null,
            price: $data['price'] ?? null,
            stock: $data['stock'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'category' => $this->category,
            'price' => $this->price,
            'stock' => $this->stock,
            'photo' => $this->photo,
        ]; }
}