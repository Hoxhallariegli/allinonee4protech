<?php

namespace App\Domain\PharmacyManagement\Supplier\Actions;

use App\Models\PharmacyManagement\Supplier;
use App\Models\AuditTrail;

class DeleteSupplierAction
{
    public function execute(Supplier $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Suppliers');
        return $model->delete(); 
    }
}