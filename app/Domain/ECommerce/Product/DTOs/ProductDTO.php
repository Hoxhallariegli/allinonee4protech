<?php

namespace App\Domain\ECommerce\Product\DTOs;

class ProductDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $price,
        public readonly mixed $stock,
        public readonly mixed $vendor_id,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            price: $data['price'] ?? null,
            stock: $data['stock'] ?? null,
            vendor_id: $data['vendor_id'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'vendor_id' => $this->vendor_id,
        ]; }
}