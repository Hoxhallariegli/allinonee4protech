<?php

namespace App\Domain\AutoRepairManagement\VehicleModel\Actions;

use App\Models\AutoRepairManagement\VehicleModel;
use App\Domain\AutoRepairManagement\VehicleModel\DTOs\VehicleModelDTO;
use App\Models\AuditTrail;

class UpdateVehicleModelAction
{
    public function execute(VehicleModel $model, VehicleModelDTO $dto): VehicleModel
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'VehicleModels');
        $model->save();
        return $model->fresh();
    }
}