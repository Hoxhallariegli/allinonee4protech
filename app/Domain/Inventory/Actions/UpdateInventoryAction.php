<?php

namespace App\Domain\Inventory\Actions;

use App\Models\Inventory;
use App\Domain\Inventory\DTOs\InventoryDTO;
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