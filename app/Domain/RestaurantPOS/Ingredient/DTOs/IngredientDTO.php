<?php

namespace App\Domain\RestaurantPOS\Ingredient\DTOs;

class IngredientDTO
{
    public function __construct(
        public readonly mixed $name,
        public readonly mixed $stock_quantity,
        public readonly mixed $unit,
    ) {}
    public static function fromArray(array $data): self { return new self(
            name: $data['name'] ?? null,
            stock_quantity: $data['stock_quantity'] ?? null,
            unit: $data['unit'] ?? null,
        ); }
    public function toArray(): array { return [
            'name' => $this->name,
            'stock_quantity' => $this->stock_quantity,
            'unit' => $this->unit,
        ]; }
}