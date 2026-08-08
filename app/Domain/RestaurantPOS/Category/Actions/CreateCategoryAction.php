<?php

namespace App\Domain\RestaurantPOS\Category\Actions;

use App\Models\RestaurantPOS\Category;
use App\Domain\RestaurantPOS\Category\DTOs\CategoryDTO;
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