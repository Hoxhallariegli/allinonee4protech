<?php

namespace App\Domain\RestaurantPOS\Ingredient\Actions;

use App\Models\RestaurantPOS\Ingredient;
use App\Domain\RestaurantPOS\Ingredient\DTOs\IngredientDTO;
use App\Models\AuditTrail;

class UpdateIngredientAction
{
    public function execute(Ingredient $model, IngredientDTO $dto): Ingredient
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Ingredients');
        $model->save();
        return $model->fresh();
    }
}