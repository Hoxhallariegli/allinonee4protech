<?php

namespace App\Domain\AutoRepairManagement\VehicleModel\Actions;

use App\Models\AutoRepairManagement\VehicleModel;
use App\Models\AuditTrail;

class DeleteVehicleModelAction
{
    public function execute(VehicleModel $model): bool 
    {
        AuditTrail::log($model, 'delete', 'VehicleModels');
        return $model->delete(); 
    }
}