<?php

namespace App\Domain\WarehouseManagement\Product\Actions;

use App\Models\WarehouseManagement\Product;
use App\Models\AuditTrail;

class DeleteProductAction
{
    public function execute(Product $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Products');
        return $model->delete(); 
    }
}