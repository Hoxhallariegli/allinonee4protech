<?php

namespace App\Domain\ECommerce\Product\Actions;

use App\Models\ECommerce\Product;
use App\Domain\ECommerce\Product\DTOs\ProductDTO;
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