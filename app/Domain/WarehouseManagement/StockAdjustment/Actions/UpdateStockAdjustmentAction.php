<?php

namespace App\Domain\WarehouseManagement\StockAdjustment\Actions;

use App\Models\WarehouseManagement\StockAdjustment;
use App\Domain\WarehouseManagement\StockAdjustment\DTOs\StockAdjustmentDTO;
use App\Models\AuditTrail;

class UpdateStockAdjustmentAction
{
    public function execute(StockAdjustment $model, StockAdjustmentDTO $dto): StockAdjustment
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'StockAdjustments');
        $model->save();
        return $model->fresh();
    }
}