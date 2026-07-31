<?php

namespace App\Domain\WarehouseManagement\Supplier\Actions;

use App\Models\WarehouseManagement\Supplier;
use App\Domain\WarehouseManagement\Supplier\DTOs\SupplierDTO;
use App\Models\AuditTrail;

class CreateSupplierAction
{
    public function execute(SupplierDTO $dto): Supplier 
    {
        $item = Supplier::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Suppliers');
        return $item;
    }
}