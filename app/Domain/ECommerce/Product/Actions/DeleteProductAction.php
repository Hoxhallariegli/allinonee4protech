<?php

namespace App\Domain\ECommerce\Product\Actions;

use App\Models\ECommerce\Product;
use App\Models\AuditTrail;

class DeleteProductAction
{
    public function execute(Product $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Products');
        return $model->delete(); 
    }
}