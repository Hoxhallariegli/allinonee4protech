<?php

namespace App\Domain\RestaurantPOS\Ingredient\Actions;

use App\Models\RestaurantPOS\Ingredient;
use App\Domain\RestaurantPOS\Ingredient\DTOs\IngredientDTO;
use App\Models\AuditTrail;

class CreateIngredientAction
{
    public function execute(IngredientDTO $dto): Ingredient 
    {
        $item = Ingredient::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Ingredients');
        return $item;
    }
}