<?php

namespace App\Domain\Product\DTOs;

class ProductDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $category_id,
        public readonly ?float $price,
        public readonly ?int $quantity,
        public readonly ?string $no,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            category_id: $data['category_id'] ?? null,
            price: $data['price'] ?? null,
            quantity: $data['quantity'] ?? null,
            no: $data['no'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'no' => $this->no,
        ]; }
}