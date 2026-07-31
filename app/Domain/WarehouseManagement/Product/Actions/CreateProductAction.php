<?php

namespace App\Domain\WarehouseManagement\Product\Actions;

use App\Models\WarehouseManagement\Product;
use App\Domain\WarehouseManagement\Product\DTOs\ProductDTO;
use App\Models\AuditTrail;

class CreateProductAction
{
    public function execute(ProductDTO $dto): Product 
    {
        $item = Product::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Products');
        return $item;
    }
}