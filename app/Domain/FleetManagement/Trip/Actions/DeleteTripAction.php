<?php

namespace App\Domain\FleetManagement\Trip\Actions;

use App\Models\FleetManagement\Trip;
use App\Models\AuditTrail;

class DeleteTripAction
{
    public function execute(Trip $model): bool 
    {
        AuditTrail::log($model, 'delete', 'Trips');
        return $model->delete(); 
    }
}