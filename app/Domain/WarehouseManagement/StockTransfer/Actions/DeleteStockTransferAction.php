<?php

namespace App\Domain\WarehouseManagement\StockTransfer\Actions;

use App\Models\WarehouseManagement\StockTransfer;
use App\Models\AuditTrail;

class DeleteStockTransferAction
{
    public function execute(StockTransfer $model): bool 
    {
        AuditTrail::log($model, 'delete', 'StockTransfers');
        return $model->delete(); 
    }
}