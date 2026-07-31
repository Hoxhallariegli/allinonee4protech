<?php

namespace App\Domain\RestaurantPOS\DiningTable\Actions;

use App\Models\RestaurantPOS\DiningTable;
use App\Domain\RestaurantPOS\DiningTable\DTOs\DiningTableDTO;
use App\Models\AuditTrail;

class CreateDiningTableAction
{
    public function execute(DiningTableDTO $dto): DiningTable 
    {
        $item = DiningTable::create($dto->toArray());
        AuditTrail::log($item, 'create', 'DiningTables');
        return $item;
    }
}