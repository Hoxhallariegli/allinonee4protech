<?php

namespace App\Domain\AutoRepairManagement\PurchaseOrder\Actions;

use App\Models\AutoRepairManagement\PurchaseOrder;
use App\Models\AuditTrail;

class DeletePurchaseOrderAction
{
    public function execute(PurchaseOrder $model): bool 
    {
        AuditTrail::log($model, 'delete', 'PurchaseOrders');
        return $model->delete(); 
    }
}