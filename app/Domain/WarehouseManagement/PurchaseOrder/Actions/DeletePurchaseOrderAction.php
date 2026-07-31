<?php

namespace App\Domain\WarehouseManagement\PurchaseOrder\Actions;

use App\Models\WarehouseManagement\PurchaseOrder;
use App\Models\AuditTrail;

class DeletePurchaseOrderAction
{
    public function execute(PurchaseOrder $model): bool 
    {
        AuditTrail::log($model, 'delete', 'PurchaseOrders');
        return $model->delete(); 
    }
}