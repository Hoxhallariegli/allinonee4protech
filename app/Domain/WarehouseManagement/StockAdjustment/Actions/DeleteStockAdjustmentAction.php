<?php

namespace App\Domain\WarehouseManagement\StockAdjustment\Actions;

use App\Models\WarehouseManagement\StockAdjustment;
use App\Models\AuditTrail;

class DeleteStockAdjustmentAction
{
    public function execute(StockAdjustment $model): bool 
    {
        AuditTrail::log($model, 'delete', 'StockAdjustments');
        return $model->delete(); 
    }
}