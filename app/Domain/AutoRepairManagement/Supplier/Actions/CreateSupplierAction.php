<?php

namespace App\Domain\AutoRepairManagement\Supplier\Actions;

use App\Models\AutoRepairManagement\Supplier;
use App\Domain\AutoRepairManagement\Supplier\DTOs\SupplierDTO;
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