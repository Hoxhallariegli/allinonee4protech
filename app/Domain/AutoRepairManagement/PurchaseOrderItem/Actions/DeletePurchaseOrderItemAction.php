<?php

namespace App\Domain\AutoRepairManagement\PurchaseOrderItem\Actions;

use App\Models\AutoRepairManagement\PurchaseOrderItem;
use App\Models\AuditTrail;

class DeletePurchaseOrderItemAction
{
    public function execute(PurchaseOrderItem $model): bool 
    {
        AuditTrail::log($model, 'delete', 'PurchaseOrderItems');
        return $model->delete(); 
    }
}