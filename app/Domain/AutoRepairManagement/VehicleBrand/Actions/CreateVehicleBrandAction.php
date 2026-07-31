<?php

namespace App\Domain\AutoRepairManagement\VehicleBrand\Actions;

use App\Models\AutoRepairManagement\VehicleBrand;
use App\Domain\AutoRepairManagement\VehicleBrand\DTOs\VehicleBrandDTO;
use App\Models\AuditTrail;

class CreateVehicleBrandAction
{
    public function execute(VehicleBrandDTO $dto): VehicleBrand 
    {
        $item = VehicleBrand::create($dto->toArray());
        AuditTrail::log($item, 'create', 'VehicleBrands');
        return $item;
    }
}