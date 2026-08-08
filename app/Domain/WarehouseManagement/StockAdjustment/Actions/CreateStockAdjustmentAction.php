<?php

namespace App\Domain\WarehouseManagement\StockAdjustment\Actions;

use App\Models\WarehouseManagement\StockAdjustment;
use App\Domain\WarehouseManagement\StockAdjustment\DTOs\StockAdjustmentDTO;
use App\Models\AuditTrail;

class CreateStockAdjustmentAction
{
    public function execute(StockAdjustmentDTO $dto): StockAdjustment 
    {
        $item = StockAdjustment::create($dto->toArray());
        AuditTrail::log($item, 'create', 'StockAdjustments');
        return $item;
    }
}