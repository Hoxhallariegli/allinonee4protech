<?php

namespace App\Domain\RestaurantPOS\Recipe\Actions;

use App\Models\RestaurantPOS\Recipe;
use App\Domain\RestaurantPOS\Recipe\DTOs\RecipeDTO;
use App\Models\AuditTrail;

class UpdateRecipeAction
{
    public function execute(Recipe $model, RecipeDTO $dto): Recipe
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Recipes');
        $model->save();
        return $model->fresh();
    }
}