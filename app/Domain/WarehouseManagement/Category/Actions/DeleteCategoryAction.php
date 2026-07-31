<?php

namespace App\Domain\WarehouseManagement\Category\Actions;

use App\Models\WarehouseManagement\Category;
use App\Models\AuditTrail;

class DeleteCategoryAction
{
    public function execute(Category $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Categories');
        return $model->delete(); 
    }
}