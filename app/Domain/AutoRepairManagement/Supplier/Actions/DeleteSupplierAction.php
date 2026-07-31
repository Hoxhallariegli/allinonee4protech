<?php

namespace App\Domain\AutoRepairManagement\Supplier\Actions;

use App\Models\AutoRepairManagement\Supplier;
use App\Models\AuditTrail;

class DeleteSupplierAction
{
    public function execute(Supplier $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Suppliers');
        return $model->delete(); 
    }
}