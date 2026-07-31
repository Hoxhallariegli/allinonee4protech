<?php

namespace App\Domain\WarehouseManagement\Product\DTOs;

class ProductDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $category_id,
        public readonly mixed $price,
        public readonly mixed $stock,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            category_id: $data['category_id'] ?? null,
            price: $data['price'] ?? null,
            stock: $data['stock'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'stock' => $this->stock,
        ]; }
}