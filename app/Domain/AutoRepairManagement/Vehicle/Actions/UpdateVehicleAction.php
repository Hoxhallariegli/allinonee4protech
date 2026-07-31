<?php

namespace App\Domain\AutoRepairManagement\Vehicle\Actions;

use App\Models\AutoRepairManagement\Vehicle;
use App\Domain\AutoRepairManagement\Vehicle\DTOs\VehicleDTO;
use App\Models\AuditTrail;

class UpdateVehicleAction
{
    public function execute(Vehicle $model, VehicleDTO $dto): Vehicle
    {
        $model->fill($dto->toArray());
        AuditTrail::log($model, 'update', 'Vehicles');
        $model->save();
        return $model->fresh();
    }
}