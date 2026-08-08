<?php

namespace App\Domain\Finance\Category\Actions;

use App\Models\Finance\Category;
use App\Models\AuditTrail;

class DeleteCategoryAction
{
    public function execute(Category $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Categories');
        return $model->delete(); 
    }
}