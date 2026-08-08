<?php

namespace App\Domain\Finance\Category\Actions;

use App\Models\Finance\Category;
use App\Domain\Finance\Category\DTOs\CategoryDTO;
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