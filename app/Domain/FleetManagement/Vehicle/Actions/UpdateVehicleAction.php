<?php

namespace App\Domain\FleetManagement\Vehicle\Actions;

use App\Models\FleetManagement\Vehicle;
use App\Domain\FleetManagement\Vehicle\DTOs\VehicleDTO;
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