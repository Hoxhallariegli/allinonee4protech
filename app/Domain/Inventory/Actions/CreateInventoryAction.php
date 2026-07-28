<?php

namespace App\Domain\Inventory\Actions;

use App\Models\Inventory;
use App\Domain\Inventory\DTOs\InventoryDTO;
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