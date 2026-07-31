<?php

namespace App\Domain\ConstructionERP\Supplier\Actions;

use App\Models\ConstructionERP\Supplier;
use App\Domain\ConstructionERP\Supplier\DTOs\SupplierDTO;
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