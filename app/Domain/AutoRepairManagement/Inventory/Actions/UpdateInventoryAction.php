<?php

namespace App\Domain\AutoRepairManagement\Inventory\Actions;

use App\Models\AutoRepairManagement\Inventory;
use App\Domain\AutoRepairManagement\Inventory\DTOs\InventoryDTO;
use App\Models\AuditTrail;

class UpdateInventoryAction
{
    public function execute(Inventory $model, InventoryDTO $dto): Inventory
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Inventories');
        $model->save();
        return $model->fresh();
    }
}