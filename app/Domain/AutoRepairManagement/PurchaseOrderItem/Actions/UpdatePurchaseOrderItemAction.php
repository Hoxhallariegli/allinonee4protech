<?php

namespace App\Domain\AutoRepairManagement\PurchaseOrderItem\Actions;

use App\Models\AutoRepairManagement\PurchaseOrderItem;
use App\Domain\AutoRepairManagement\PurchaseOrderItem\DTOs\PurchaseOrderItemDTO;
use App\Models\AuditTrail;

class UpdatePurchaseOrderItemAction
{
    public function execute(PurchaseOrderItem $model, PurchaseOrderItemDTO $dto): PurchaseOrderItem
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'PurchaseOrderItems');
        $model->save();
        return $model->fresh();
    }
}