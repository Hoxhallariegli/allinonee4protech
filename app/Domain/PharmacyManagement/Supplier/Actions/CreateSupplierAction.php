<?php

namespace App\Domain\PharmacyManagement\Supplier\Actions;

use App\Models\PharmacyManagement\Supplier;
use App\Domain\PharmacyManagement\Supplier\DTOs\SupplierDTO;
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