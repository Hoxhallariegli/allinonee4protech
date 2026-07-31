<?php

namespace App\Domain\ConstructionERP\Supplier\Actions;

use App\Models\ConstructionERP\Supplier;
use App\Domain\ConstructionERP\Supplier\DTOs\SupplierDTO;
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