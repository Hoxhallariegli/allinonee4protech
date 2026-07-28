<?php

namespace App\Domain\PurchaseOrderItem\Actions;

use App\Models\PurchaseOrderItem;
use App\Domain\PurchaseOrderItem\DTOs\PurchaseOrderItemDTO;
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