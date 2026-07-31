<?php

namespace App\Domain\WarehouseManagement\Category\Actions;

use App\Models\WarehouseManagement\Category;
use App\Domain\WarehouseManagement\Category\DTOs\CategoryDTO;
use App\Models\AuditTrail;

class UpdateCategoryAction
{
    public function execute(Category $model, CategoryDTO $dto): Category
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Categories');
        $model->save();
        return $model->fresh();
    }
}