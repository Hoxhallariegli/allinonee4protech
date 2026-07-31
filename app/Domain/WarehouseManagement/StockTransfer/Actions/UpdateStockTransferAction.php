<?php

namespace App\Domain\WarehouseManagement\StockTransfer\Actions;

use App\Models\WarehouseManagement\StockTransfer;
use App\Domain\WarehouseManagement\StockTransfer\DTOs\StockTransferDTO;
use App\Models\AuditTrail;

class UpdateStockTransferAction
{
    public function execute(StockTransfer $model, StockTransferDTO $dto): StockTransfer
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'StockTransfers');
        $model->save();
        return $model->fresh();
    }
}