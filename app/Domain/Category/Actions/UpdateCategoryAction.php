<?php

namespace App\Domain\Category\Actions;

use App\Models\Category;
use App\Domain\Category\DTOs\CategoryDTO;

class UpdateCategoryAction
{
    public function execute(Category $model, CategoryDTO $dto): bool { return $model->update($dto->toArray()); }
}