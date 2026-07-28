<?php

namespace App\Domain\Part\DTOs;

class PartDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $price,
        public readonly mixed $stock,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            price: $data['price'] ?? null,
            stock: $data['stock'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
        ]; }
}