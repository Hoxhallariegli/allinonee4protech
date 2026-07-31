<?php

namespace App\Domain\AutoRepairManagement\Inventory\Actions;

use App\Models\AutoRepairManagement\Inventory;
use App\Models\AuditTrail;

class DeleteInventoryAction
{
    public function execute(Inventory $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Inventories');
        return $model->delete(); 
    }
}