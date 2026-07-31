<?php

namespace App\Domain\WarehouseManagement\PurchaseOrder\Actions;

use App\Models\WarehouseManagement\PurchaseOrder;
use App\Domain\WarehouseManagement\PurchaseOrder\DTOs\PurchaseOrderDTO;
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