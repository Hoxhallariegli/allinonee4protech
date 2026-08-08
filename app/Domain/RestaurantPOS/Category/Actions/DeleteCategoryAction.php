<?php

namespace App\Domain\RestaurantPOS\Category\Actions;

use App\Models\RestaurantPOS\Category;
use App\Models\AuditTrail;

class DeleteCategoryAction
{
    public function execute(Category $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Categories');
        return $model->delete(); 
    }
}