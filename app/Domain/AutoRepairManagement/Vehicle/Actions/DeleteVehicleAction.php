<?php

namespace App\Domain\AutoRepairManagement\Vehicle\Actions;

use App\Models\AutoRepairManagement\Vehicle;
use App\Models\AuditTrail;

class DeleteVehicleAction
{
    public function execute(Vehicle $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Vehicles');
        return $model->delete(); 
    }
}