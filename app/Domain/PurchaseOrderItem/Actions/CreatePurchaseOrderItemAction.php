<?php

namespace App\Domain\PurchaseOrderItem\Actions;

use App\Models\PurchaseOrderItem;
use App\Domain\PurchaseOrderItem\DTOs\PurchaseOrderItemDTO;
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