<?php

namespace App\Domain\Inventory\Actions;

use App\Models\Inventory;
use App\Models\AuditTrail;

class DeleteInventoryAction
{
    public function execute(Inventory $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Inventories');
        return $model->delete(); 
    }
}