<?php

namespace App\Domain\PurchaseOrder\Actions;

use App\Models\PurchaseOrder;
use App\Domain\PurchaseOrder\DTOs\PurchaseOrderDTO;
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