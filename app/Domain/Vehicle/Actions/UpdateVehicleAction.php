<?php

namespace App\Domain\Vehicle\Actions;

use App\Models\Vehicle;
use App\Domain\Vehicle\DTOs\VehicleDTO;
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