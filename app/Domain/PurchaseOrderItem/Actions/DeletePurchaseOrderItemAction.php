<?php

namespace App\Domain\PurchaseOrderItem\Actions;

use App\Models\PurchaseOrderItem;
use App\Models\AuditTrail;

class DeletePurchaseOrderItemAction
{
    public function execute(PurchaseOrderItem $model): bool 
    {
        AuditTrail::log($model, 'delete', 'PurchaseOrderItems');
        return $model->delete(); 
    }
}