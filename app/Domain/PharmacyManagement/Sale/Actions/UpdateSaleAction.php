<?php

namespace App\Domain\PharmacyManagement\Sale\Actions;

use App\Models\PharmacyManagement\Sale;
use App\Domain\PharmacyManagement\Sale\DTOs\SaleDTO;
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