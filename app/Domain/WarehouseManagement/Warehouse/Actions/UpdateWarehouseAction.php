<?php

namespace App\Domain\WarehouseManagement\Warehouse\Actions;

use App\Models\WarehouseManagement\Warehouse;
use App\Domain\WarehouseManagement\Warehouse\DTOs\WarehouseDTO;
use App\Models\AuditTrail;

class UpdateWarehouseAction
{
    public function execute(Warehouse $model, WarehouseDTO $dto): Warehouse
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Warehouses');
        $model->save();
        return $model->fresh();
    }
}