<?php

namespace App\Domain\ConstructionERP\Material\DTOs;

class MaterialDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $unit,
        public readonly mixed $price,
        public readonly mixed $stock,
        public readonly mixed $photo,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            unit: $data['unit'] ?? null,
            price: $data['price'] ?? null,
            stock: $data['stock'] ?? null,
            photo: $data['photo'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'unit' => $this->unit,
            'price' => $this->price,
            'stock' => $this->stock,
            'photo' => $this->photo,
        ]; }
}