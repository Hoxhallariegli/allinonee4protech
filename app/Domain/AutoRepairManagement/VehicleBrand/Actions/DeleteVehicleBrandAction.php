<?php

namespace App\Domain\AutoRepairManagement\VehicleBrand\Actions;

use App\Models\AutoRepairManagement\VehicleBrand;
use App\Models\AuditTrail;

class DeleteVehicleBrandAction
{
    public function execute(VehicleBrand $model): bool 
    {
        AuditTrail::log($model, 'delete', 'VehicleBrands');
        return $model->delete(); 
    }
}