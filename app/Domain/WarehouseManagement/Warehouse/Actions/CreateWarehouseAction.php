<?php

namespace App\Domain\WarehouseManagement\Warehouse\Actions;

use App\Models\WarehouseManagement\Warehouse;
use App\Domain\WarehouseManagement\Warehouse\DTOs\WarehouseDTO;
use App\Models\AuditTrail;

class CreateWarehouseAction
{
    public function execute(WarehouseDTO $dto): Warehouse 
    {
        $item = Warehouse::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Warehouses');
        return $item;
    }
}