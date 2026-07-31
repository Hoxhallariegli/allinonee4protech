<?php

namespace App\Domain\AutoRepairManagement\VehicleBrand\Actions;

use App\Models\AutoRepairManagement\VehicleBrand;
use App\Domain\AutoRepairManagement\VehicleBrand\DTOs\VehicleBrandDTO;
use App\Models\AuditTrail;

class UpdateVehicleBrandAction
{
    public function execute(VehicleBrand $model, VehicleBrandDTO $dto): VehicleBrand
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'VehicleBrands');
        $model->save();
        return $model->fresh();
    }
}