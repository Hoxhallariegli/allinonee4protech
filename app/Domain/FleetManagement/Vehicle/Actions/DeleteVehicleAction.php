<?php

namespace App\Domain\FleetManagement\Vehicle\Actions;

use App\Models\FleetManagement\Vehicle;
use App\Models\AuditTrail;

class DeleteVehicleAction
{
    public function execute(Vehicle $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Vehicles');
        return $model->delete(); 
    }
}