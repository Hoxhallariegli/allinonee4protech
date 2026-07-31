<?php

namespace App\Domain\AutoRepairManagement\VehicleModel\Actions;

use App\Models\AutoRepairManagement\VehicleModel;
use App\Domain\AutoRepairManagement\VehicleModel\DTOs\VehicleModelDTO;
use App\Models\AuditTrail;

class CreateVehicleModelAction
{
    public function execute(VehicleModelDTO $dto): VehicleModel 
    {
        $item = VehicleModel::create($dto->toArray());
        AuditTrail::log($item, 'create', 'VehicleModels');
        return $item;
    }
}