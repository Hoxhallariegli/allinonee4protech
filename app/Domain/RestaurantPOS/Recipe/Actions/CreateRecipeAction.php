<?php

namespace App\Domain\RestaurantPOS\Recipe\Actions;

use App\Models\RestaurantPOS\Recipe;
use App\Domain\RestaurantPOS\Recipe\DTOs\RecipeDTO;
use App\Models\AuditTrail;

class CreateRecipeAction
{
    public function execute(RecipeDTO $dto): Recipe 
    {
        $item = Recipe::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Recipes');
        return $item;
    }
}