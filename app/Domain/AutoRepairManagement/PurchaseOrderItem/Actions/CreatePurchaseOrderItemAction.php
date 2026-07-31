<?php

namespace App\Domain\AutoRepairManagement\PurchaseOrderItem\Actions;

use App\Models\AutoRepairManagement\PurchaseOrderItem;
use App\Domain\AutoRepairManagement\PurchaseOrderItem\DTOs\PurchaseOrderItemDTO;
use App\Models\AuditTrail;

class CreatePurchaseOrderItemAction
{
    public function execute(PurchaseOrderItemDTO $dto): PurchaseOrderItem 
    {
        $item = PurchaseOrderItem::create($dto->toArray());
        AuditTrail::log($item, 'create', 'PurchaseOrderItems');
        return $item;
    }
}