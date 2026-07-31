<?php

namespace App\Domain\WarehouseManagement\Warehouse\Actions;

use App\Models\WarehouseManagement\Warehouse;
use App\Models\AuditTrail;

class DeleteWarehouseAction
{
    public function execute(Warehouse $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Warehouses');
        return $model->delete(); 
    }
}