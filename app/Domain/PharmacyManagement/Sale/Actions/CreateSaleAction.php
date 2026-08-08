<?php

namespace App\Domain\PharmacyManagement\Sale\Actions;

use App\Models\PharmacyManagement\Sale;
use App\Domain\PharmacyManagement\Sale\DTOs\SaleDTO;
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