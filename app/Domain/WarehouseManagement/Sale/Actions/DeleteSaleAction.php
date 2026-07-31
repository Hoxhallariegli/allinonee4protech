<?php

namespace App\Domain\WarehouseManagement\Sale\Actions;

use App\Models\WarehouseManagement\Sale;
use App\Models\AuditTrail;

class DeleteSaleAction
{
    public function execute(Sale $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Sales');
        return $model->delete(); 
    }
}