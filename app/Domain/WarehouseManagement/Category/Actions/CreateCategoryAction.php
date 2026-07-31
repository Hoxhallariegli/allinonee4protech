<?php

namespace App\Domain\WarehouseManagement\Category\Actions;

use App\Models\WarehouseManagement\Category;
use App\Domain\WarehouseManagement\Category\DTOs\CategoryDTO;
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