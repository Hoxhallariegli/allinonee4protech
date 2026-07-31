<?php

namespace App\Domain\AutoRepairManagement\Supplier\Actions;

use App\Models\AutoRepairManagement\Supplier;
use App\Domain\AutoRepairManagement\Supplier\DTOs\SupplierDTO;
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