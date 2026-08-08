<?php

namespace App\Domain\Finance\Category\Actions;

use App\Models\Finance\Category;
use App\Domain\Finance\Category\DTOs\CategoryDTO;
use App\Models\AuditTrail;

class CreateCategoryAction
{
    public function execute(CategoryDTO $dto): Category 
    {
        $item = Category::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Categories');
        return $item;
    }
}