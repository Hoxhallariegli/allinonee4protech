<?php

namespace App\Domain\RestaurantPOS\DiningTable\Actions;

use App\Models\RestaurantPOS\DiningTable;
use App\Domain\RestaurantPOS\DiningTable\DTOs\DiningTableDTO;
use App\Models\AuditTrail;

class UpdateDiningTableAction
{
    public function execute(DiningTable $model, DiningTableDTO $dto): DiningTable
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'DiningTables');
        $model->save();
        return $model->fresh();
    }
}