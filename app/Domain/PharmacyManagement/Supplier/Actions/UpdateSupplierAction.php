<?php

namespace App\Domain\PharmacyManagement\Supplier\Actions;

use App\Models\PharmacyManagement\Supplier;
use App\Domain\PharmacyManagement\Supplier\DTOs\SupplierDTO;
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