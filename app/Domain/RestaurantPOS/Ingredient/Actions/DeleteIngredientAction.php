<?php

namespace App\Domain\RestaurantPOS\Ingredient\Actions;

use App\Models\RestaurantPOS\Ingredient;
use App\Models\AuditTrail;

class DeleteIngredientAction
{
    public function execute(Ingredient $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Ingredients');
        return $model->delete(); 
    }
}