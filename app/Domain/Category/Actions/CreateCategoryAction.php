<?php

namespace App\Domain\Category\Actions;

use App\Models\Category;
use App\Domain\Category\DTOs\CategoryDTO;

class CreateCategoryAction
{
    public function execute(CategoryDTO $dto): Category { return Category::create($dto->toArray()); }
}