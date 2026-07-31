<?php

namespace App\Domain\ConstructionERP\PurchaseOrder\Actions;

use App\Models\ConstructionERP\PurchaseOrder;
use App\Models\AuditTrail;

class DeletePurchaseOrderAction
{
    public function execute(PurchaseOrder $model): bool 
    {
        AuditTrail::log($model, 'delete', 'PurchaseOrders');
        return $model->delete(); 
    }
}