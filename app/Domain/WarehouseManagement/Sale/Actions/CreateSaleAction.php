<?php

namespace App\Domain\WarehouseManagement\Sale\Actions;

use App\Models\WarehouseManagement\Sale;
use App\Domain\WarehouseManagement\Sale\DTOs\SaleDTO;
use App\Models\AuditTrail;

class CreateSaleAction
{
    public function execute(SaleDTO $dto): Sale 
    {
        $item = Sale::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Sales');
        return $item;
    }
}