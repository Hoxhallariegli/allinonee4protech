<?php

namespace App\Domain\PurchaseOrder\Actions;

use App\Models\PurchaseOrder;
use App\Models\AuditTrail;

class DeletePurchaseOrderAction
{
    public function execute(PurchaseOrder $model): bool 
    {
        AuditTrail::log($model, 'delete', 'PurchaseOrders');
        return $model->delete(); 
    }
}