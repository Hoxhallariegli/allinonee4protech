<?php

namespace App\Domain\RestaurantPOS\Category\Actions;

use App\Models\RestaurantPOS\Category;
use App\Domain\RestaurantPOS\Category\DTOs\CategoryDTO;
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