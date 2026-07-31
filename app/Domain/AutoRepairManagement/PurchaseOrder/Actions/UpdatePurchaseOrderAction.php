<?php

namespace App\Domain\AutoRepairManagement\PurchaseOrder\Actions;

use App\Models\AutoRepairManagement\PurchaseOrder;
use App\Domain\AutoRepairManagement\PurchaseOrder\DTOs\PurchaseOrderDTO;
use App\Models\AuditTrail;

class UpdatePurchaseOrderAction
{
    public function execute(PurchaseOrder $model, PurchaseOrderDTO $dto): PurchaseOrder
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'PurchaseOrders');
        $model->save();
        return $model->fresh();
    }
}