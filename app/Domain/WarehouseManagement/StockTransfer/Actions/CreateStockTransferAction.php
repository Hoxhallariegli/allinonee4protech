<?php

namespace App\Domain\WarehouseManagement\StockTransfer\Actions;

use App\Models\WarehouseManagement\StockTransfer;
use App\Domain\WarehouseManagement\StockTransfer\DTOs\StockTransferDTO;
use App\Models\AuditTrail;

class CreateStockTransferAction
{
    public function execute(StockTransferDTO $dto): StockTransfer 
    {
        $item = StockTransfer::create($dto->toArray());
        AuditTrail::log($item, 'create', 'StockTransfers');
        return $item;
    }
}