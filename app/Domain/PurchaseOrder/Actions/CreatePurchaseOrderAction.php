<?php

namespace App\Domain\PurchaseOrder\Actions;

use App\Models\PurchaseOrder;
use App\Domain\PurchaseOrder\DTOs\PurchaseOrderDTO;
use App\Models\AuditTrail;

class CreatePurchaseOrderAction
{
    public function execute(PurchaseOrderDTO $dto): PurchaseOrder 
    {
        $item = PurchaseOrder::create($dto->toArray());
        AuditTrail::log($item, 'create', 'PurchaseOrders');
        return $item;
    }
}