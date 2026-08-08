<?php

namespace App\Domain\AgricultureManagement\InventorySupply\Actions;

use App\Models\AgricultureManagement\InventorySupply;
use App\Domain\AgricultureManagement\InventorySupply\DTOs\InventorySupplyDTO;
use App\Models\AuditTrail;

class UpdateInventorySupplyAction
{
    public function execute(InventorySupply $model, InventorySupplyDTO $dto): InventorySupply
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'InventorySupplies');
        $model->save();
        return $model->fresh();
    }
}