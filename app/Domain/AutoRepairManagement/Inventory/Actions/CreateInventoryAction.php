<?php

namespace App\Domain\AutoRepairManagement\Inventory\Actions;

use App\Models\AutoRepairManagement\Inventory;
use App\Domain\AutoRepairManagement\Inventory\DTOs\InventoryDTO;
use App\Models\AuditTrail;

class CreateInventoryAction
{
    public function execute(InventoryDTO $dto): Inventory 
    {
        $item = Inventory::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Inventories');
        return $item;
    }
}