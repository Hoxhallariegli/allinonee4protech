<?php

namespace App\Domain\WarehouseManagement\Supplier\Actions;

use App\Models\WarehouseManagement\Supplier;
use App\Domain\WarehouseManagement\Supplier\DTOs\SupplierDTO;
use App\Models\AuditTrail;

class UpdateSupplierAction
{
    public function execute(Supplier $model, SupplierDTO $dto): Supplier
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Suppliers');
        $model->save();
        return $model->fresh();
    }
}