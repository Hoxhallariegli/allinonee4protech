<?php

namespace App\Domain\RestaurantPOS\Recipe\DTOs;

class RecipeDTO
{
    public function __construct(
        public readonly mixed $menu_item_id,
        public readonly mixed $ingredient_id,
        public readonly mixed $quantity_required,
    ) {}
    public static function fromArray(array $data): self { return new self(
            menu_item_id: $data['menu_item_id'] ?? null,
            ingredient_id: $data['ingredient_id'] ?? null,
            quantity_required: $data['quantity_required'] ?? null,
        ); }
    public function toArray(): array { return [
            'menu_item_id' => $this->menu_item_id,
            'ingredient_id' => $this->ingredient_id,
            'quantity_required' => $this->quantity_required,
        ]; }
}