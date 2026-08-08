<?php

namespace App\Domain\AgricultureManagement\InventorySupply\Actions;

use App\Models\AgricultureManagement\InventorySupply;
use App\Models\AuditTrail;

class DeleteInventorySupplyAction
{
    public function execute(InventorySupply $model): bool 
    {
        AuditTrail::log($model, 'delete', 'InventorySupplies');
        return $model->delete(); 
    }
}