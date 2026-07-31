<?php

namespace App\Domain\AutoRepairManagement\Vehicle\Actions;

use App\Models\AutoRepairManagement\Vehicle;
use App\Domain\AutoRepairManagement\Vehicle\DTOs\VehicleDTO;
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