<?php

namespace App\Domain\Vehicle\Actions;

use App\Models\Vehicle;
use App\Domain\Vehicle\DTOs\VehicleDTO;
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