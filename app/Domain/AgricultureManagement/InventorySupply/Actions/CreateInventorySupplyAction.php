<?php

namespace App\Domain\AgricultureManagement\InventorySupply\Actions;

use App\Models\AgricultureManagement\InventorySupply;
use App\Domain\AgricultureManagement\InventorySupply\DTOs\InventorySupplyDTO;
use App\Models\AuditTrail;

class CreateInventorySupplyAction
{
    public function execute(InventorySupplyDTO $dto): InventorySupply 
    {
        $item = InventorySupply::create($dto->toArray());
        AuditTrail::log($item, 'create', 'InventorySupplies');
        return $item;
    }
}