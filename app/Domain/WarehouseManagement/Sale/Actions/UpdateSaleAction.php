<?php

namespace App\Domain\WarehouseManagement\Sale\Actions;

use App\Models\WarehouseManagement\Sale;
use App\Domain\WarehouseManagement\Sale\DTOs\SaleDTO;
use App\Models\AuditTrail;

class UpdateSaleAction
{
    public function execute(Sale $model, SaleDTO $dto): Sale
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Sales');
        $model->save();
        return $model->fresh();
    }
}