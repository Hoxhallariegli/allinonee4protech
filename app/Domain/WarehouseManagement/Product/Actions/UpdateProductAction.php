<?php

namespace App\Domain\WarehouseManagement\Product\Actions;

use App\Models\WarehouseManagement\Product;
use App\Domain\WarehouseManagement\Product\DTOs\ProductDTO;
use App\Models\AuditTrail;

class UpdateProductAction
{
    public function execute(Product $model, ProductDTO $dto): Product
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Products');
        $model->save();
        return $model->fresh();
    }
}