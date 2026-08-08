<?php

namespace App\Domain\RestaurantPOS\Recipe\Actions;

use App\Models\RestaurantPOS\Recipe;
use App\Models\AuditTrail;

class DeleteRecipeAction
{
    public function execute(Recipe $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Recipes');
        return $model->delete(); 
    }
}