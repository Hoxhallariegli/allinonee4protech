<?php

namespace App\Domain\WarehouseManagement\Supplier\Actions;

use App\Models\WarehouseManagement\Supplier;
use App\Models\AuditTrail;

class DeleteSupplierAction
{
    public function execute(Supplier $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Suppliers');
        return $model->delete(); 
    }
}