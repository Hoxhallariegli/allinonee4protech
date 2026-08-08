<?php

namespace App\Domain\FleetManagement\Vehicle\Actions;

use App\Models\FleetManagement\Vehicle;
use App\Domain\FleetManagement\Vehicle\DTOs\VehicleDTO;
use App\Models\AuditTrail;

class CreateVehicleAction
{
    public function execute(VehicleDTO $dto): Vehicle 
    {
        $item = Vehicle::create($dto->toArray());
        AuditTrail::log($item, 'create', 'Vehicles');
        return $item;
    }
}