<?php

namespace App\Domain\ConstructionERP\PurchaseOrder\Actions;

use App\Models\ConstructionERP\PurchaseOrder;
use App\Domain\ConstructionERP\PurchaseOrder\DTOs\PurchaseOrderDTO;
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