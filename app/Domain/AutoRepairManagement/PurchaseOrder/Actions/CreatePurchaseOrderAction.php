<?php

namespace App\Domain\AutoRepairManagement\PurchaseOrder\Actions;

use App\Models\AutoRepairManagement\PurchaseOrder;
use App\Domain\AutoRepairManagement\PurchaseOrder\DTOs\PurchaseOrderDTO;
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