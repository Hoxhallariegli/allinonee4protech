<?php

namespace App\Domain\ConstructionERP\Supplier\Actions;

use App\Models\ConstructionERP\Supplier;
use App\Models\AuditTrail;

class DeleteSupplierAction
{
    public function execute(Supplier $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Suppliers');
        return $model->delete(); 
    }
}