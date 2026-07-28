<?php

namespace App\Domain\Vehicle\Actions;

use App\Models\Vehicle;
use App\Models\AuditTrail;

class DeleteVehicleAction
{
    public function execute(Vehicle $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Vehicles');
        return $model->delete(); 
    }
}